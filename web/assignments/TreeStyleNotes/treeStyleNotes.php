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

function showChildren($pdo, $root)
{
    showChildrenWorker($pdo, $root, 0);
}

function printNote($note, $level)
{
    $note_id = $note['note_id'];
    $title = $note['title'];
    $body = $note['body'];
    $color = $note['color_string'];
    $starred = $note['starred'];

    echo "<div id=$note_id class=\"note_level_$level\" style = \"background-color:#$color\">";

    echo "<div id='title_$note_id' class='title' contenteditable='true'>$title</div>";

    if ($starred) {
        echo "<img src='../../resources/star.png' id='star_$note_id' class='star'>";
    }

    echo "<div id='body_$note_id' class='body' contenteditable='true' onblur=\"updateNote('$note_id', '$title', '$body')\">$body</div>";

    echo "<div id='buttons_$note_id' class='buttons'>";
        echo "<form onsubmit=\"createNote('$note_id');\">";
        echo "<input type='hidden' name='parent_note_id' id='parent_note_id' value=" . $note_id . ">";
        echo "<input type='submit' value='Add Child Note'>";
        echo "</form>";

        echo "<form action='deleteNote.php' method='post'>";
        echo "<input type='hidden' name='note_id' id='note_id' value=" . $note_id . ">";
        echo "<input type='submit' value='Delete Note'>";
        echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "\n";
}

function showChildrenWorker($pdo, $root, $level) {
    $get_children_stmt = $pdo->prepare("SELECT note_id, category_id, parent_id, title, body, starred, color_string FROM notes AS n INNER JOIN colors AS c ON n.color_id = c.color_id WHERE parent_id = :parent_id AND NOT title = 'ROOT' ORDER BY note_id");

    $get_children_stmt->execute(array(':parent_id' => $root));

    $notes = $get_children_stmt->fetchall(PDO::FETCH_ASSOC);

    foreach ($notes as $note) {
        //incorporate some concept of level here - the html will keep them in order
        printNote($note, $level);
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
                data: {'parent_note_id': parent_note_id, 'title': title, 'body': body}
            });
        }

    </script>
</head>

<body>
<div id="title"><h1>Tree Style Notes</h1></div>

<?php

showChildren($pdo, 1);

?>

<form id="rootButtonForm" onsubmit="createNote(1)">
    <input type="hidden" id='note_id' name='note_id' value=1>
    <input type="submit" value="Create new root node">
</form>

</body>

</html>
