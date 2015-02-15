function saveSelection() {
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            return sel.getRangeAt(0);
        }
    } else if (document.selection && document.selection.createRange) {
        return document.selection.createRange();
    }
    return null;
}

function restoreSelection(range) {
    if (range) {
        if (window.getSelection) {
            sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (document.selection && range.select) {
            range.select();
        }
    }
}

function insertTextAtCursor(text) {
    var sel, range, html;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();
            var textNode = document.createTextNode(text) 
            range.insertNode(textNode);
            sel.removeAllRanges();
            range = range.cloneRange();
            range.selectNode(textNode);
            range.collapse(false);
            sel.addRange(range);
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.pasteHTML(text);
        range.select();
    }
}

var selRange;

function displayTextInserter() {
    selRange = saveSelection();
    document.getElementById("textInserter").style.display = "block";
    document.getElementById("textToInsert").focus();
}
 

function insertText() {
    var text = document.getElementById("textToInsert").value;
    document.getElementById("textInserter").style.display = "none";
    restoreSelection(selRange);
    document.getElementById("test").focus();
    insertTextAtCursor(text);
}
