// http://stackoverflow.com/questions/4687808/contenteditable-selected-text-save-and-restore/4690057#4690057
// http://jsfiddle.net/timdown/cCAWC/3/

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

// function getUnselectedText(containerEl) {
//     var sel, range, tempRange, before = "", after = "";
//     if (typeof window.getSelection != "undefined") {
//         sel = window.getSelection();
//         if (sel.rangeCount) {
//             range = sel.getRangeAt(0);
//         } else {
//             range = document.createRange();
//             range.collapse(true);
//         }
//         tempRange = document.createRange();
//         tempRange.selectNodeContents(containerEl);
//         tempRange.setEnd(range.startContainer, range.startOffset);
//         before = tempRange.toString();
// 
//         tempRange.selectNodeContents(containerEl);
//         tempRange.setStart(range.endContainer, range.endOffset);
//         after = tempRange.toString();
// 
//         tempRange.detach();
//     } else if ( (sel = document.selection) && sel.type != "Control") {
//         range = sel.createRange();
//         tempRange = document.body.createTextRange();
//         tempRange.moveToElementText(containerEl);
//         tempRange.setEndPoint("EndToStart", range);
//         before = tempRange.text;
// 
//         tempRange.moveToElementText(containerEl);
//         tempRange.setEndPoint("StartToEnd", range);
//         after = tempRange.text;
//     }
//     return {
//         before: before,
//         after: after
//     };
// }

var getSelectedNode = function() {
    var node,selection;
    if (window.getSelection) {
      selection = getSelection();
      node = selection.anchorNode;
    }
    if (!node && document.selection) {
        selection = document.selection
        var range = selection.getRangeAt ? selection.getRangeAt(0) : selection.createRange();
        node = range.commonAncestorContainer ? range.commonAncestorContainer :
               range.parentElement ? range.parentElement() : range.item(0);
    }
    if (node) {
      return (node.nodeName == "#text" ? node.parentNode : node);
    }
};

function getCurrentHref()
{
	var node = getSelectedNode();
	var $node = $(node);
	// console.log($node[0].tagName);
	// console.log(sirtrevorSelRange);
	
	if ($node[0].tagName == 'A')
	{
		return $node.attr('href');
	};
	return null;
}

var sirtrevorSelRange;
var sirtrevorHref;

// function insertTextAtCursor(text) {
//     var sel, range, html;
//     if (window.getSelection) {
//         sel = window.getSelection();
//         if (sel.getRangeAt && sel.rangeCount) {
//             range = sel.getRangeAt(0);
//             range.deleteContents();
//             var textNode = document.createTextNode(text) 
//             range.insertNode(textNode);
//             sel.removeAllRanges();
//             range = range.cloneRange();
//             range.selectNode(textNode);
//             range.collapse(false);
//             sel.addRange(range);
//         }
//     } else if (document.selection && document.selection.createRange) {
//         range = document.selection.createRange();
//         range.pasteHTML(text);
//         range.select();
//     }
// }


// function displayTextInserter() {
//     selRange = saveSelection();
//     document.getElementById("textInserter").style.display = "block";
//     document.getElementById("textToInsert").focus();
// }
//  
// 
// function insertText() {
//     var text = document.getElementById("textToInsert").value;
//     document.getElementById("textInserter").style.display = "none";
//     restoreSelection(selRange);
//     document.getElementById("test").focus();
//     insertTextAtCursor(text);
// }
