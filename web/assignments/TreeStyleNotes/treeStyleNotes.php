<?php
/**********************************************************
 * File: treeStyleNotes.php
 * Author: Daniel Craig
 *
 * Description: This represents the first version of my
 * TreeStyleNotes web app
 ***********************************************************/

require("getDb.php");

$pdo = getDbConnection();


function getCategories($pdo)
{
    $get_categories_stmt = $pdo->prepare("SELECT category_id, category_title FROM categories WHERE NOT category_title = 'ROOT' ORDER BY category_title");
    $get_categories_stmt->execute(array());

    return $get_categories_stmt->fetchall(PDO::FETCH_ASSOC);
}

function showChildren($pdo, $categories, $root)
{
    showChildrenWorker($pdo, $categories, $root, 0);
}

function printNote($note, $categories, $level)
{
    $note_id = $note['note_id'];
    $title = $note['title'];
    $body = $note['body'];
    $color = $note['color_string'];
    $starred = $note['starred'];

    echo "<div id=$note_id class=\"note_level_$level\" style = \"background-color:#$color\">";

    echo "<div id='title_$note_id' class='title' contenteditable='true' onblur=\"updateNote('$note_id', '$title', '$body')\">$title</div>";

    if ($starred) {
        echo "<img src='../../resources/star.png' id='star_$note_id' class='star'>";
    }

    echo "<div id='body_$note_id' class='body' contenteditable='true' onblur=\"updateNote('$note_id', '$title', '$body')\">$body</div>";

    echo "<div id='buttons_$note_id' class='buttons'>";
    echo "<select name='category'>";

    foreach ($categories as $category)
        echo "<option value=\"" . $category['category_title'] . "\">" . $category['category_title'] . "</option>";
    echo "</select>";
    echo "<input type='button' value='Add Child Note' onclick='createNote($note_id)'>";
    echo "<input type='button' value='Delete Note' onclick='deleteNote($note_id)'>";
    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "\n";
}

function showChildrenWorker($pdo, $categories, $root, $level) {
    $get_children_stmt = $pdo->prepare("SELECT note_id, c.category_title, parent_id, title, body, starred, color_string FROM notes n INNER JOIN categories c ON n.category_id = c.category_id INNER JOIN colors co ON c.color_id = co.color_id WHERE parent_id = :parent_id AND NOT title = 'ROOT' ORDER BY note_id");
    $get_children_stmt->execute(array(':parent_id' => $root));

    $notes = $get_children_stmt->fetchall(PDO::FETCH_ASSOC);

    foreach ($notes as $note) {
        //incorporate some concept of level here - the html will keep them in order
        printNote($note, $categories, $level);
        showChildrenWorker($pdo, $note['note_id'], $level + 1);
    }
}

?>

<!doctype html>
<html>

<head>
    <link type="text/css" rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function updateNote(note_id) {
            var title = document.getElementById('title_'.concat(note_id)).innerText;
            var body = document.getElementById('body_'.concat(note_id)).innerText;

            jQuery.ajax ({
                type: "POST",
                url: "updateNote.php",
                data: {'note_id': note_id, 'title': title, 'body': body}
            });
        }

        function createNote(parent_note_id) {
            var title = "Edit me!";
            var body = "Your edits are automatically saved when you click away.";

            jQuery.ajax ({
                type: "POST",
                url: "createNote.php",
                data: {'parent_note_id': parent_note_id, 'title': title, 'body': body},
                error: function () {
                    //alert("fail");
                    setTimeout(function () {
                        getMyJson();
                    }, 5000)
                }
            });

            location = location;
        }

        function deleteNote(note_id) {
            jQuery.ajax ({
                type: "POST",
                url: "deleteNote.php",
                data: {'note_id': note_id},
                error: function () {
                    //alert("fail");
                    setTimeout(function () {
                        getMyJson();
                    }, 5000)
                }
            });

            location = location;
        }

    </script>
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php

$categories = getCategories($pdo);
showChildren($pdo, $categories,1);

?>

<form id="rootButtonForm" onsubmit="createNote(1)">
    <input type="hidden" id='note_id' name='note_id' value=1>
    <input type="submit" value="Create new root node">
</form>

</body>

</html>
