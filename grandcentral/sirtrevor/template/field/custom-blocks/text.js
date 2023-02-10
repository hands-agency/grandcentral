// remove link duplication when copy a link
SirTrevor.setBlockOptions('Text', {
  onContentPasted: function(event){
    // Content pasted. Delegate to the drop parse method
    fixBrowserCopyLinkBehavior(event)
  }
})

SirTrevor.setBlockOptions('List', {
  onContentPasted: function(event){
    // Content pasted. Delegate to the drop parse method
    fixBrowserCopyLinkBehavior(event)
  }
})
SirTrevor.setBlockOptions('Quote', {
  onContentPasted: function(event){
    // Content pasted. Delegate to the drop parse method
    fixBrowserCopyLinkBehavior(event)
  }
})

function fixBrowserCopyLinkBehavior (event) {
  const content = event.currentTarget.innerHTML
  const regexp = /href="([^["]*)\[[a-z_0-9]*\]"/gm
  const test = [...content.matchAll(regexp)]
  test.every(match => {
    if (match[1] && match[1].length > 0) {
      event.currentTarget.innerHTML = content.split(match[1]).join('')
      return false
    }
    return true
  })
}