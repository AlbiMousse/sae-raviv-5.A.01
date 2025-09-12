function generateIllustrationIndex() {
  const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT) ;
  let textNode = null ;
  while (walker.nextNode()) {
    if (walker.currentNode.nodeValue.includes("% lof %")) {
      textNode = walker.currentNode ;
      break ;
    }
  }
  if (!textNode) return ;

  const container = document.createElement("div") ;
  container.id = 'lof' ;
  textNode.parentNode.replaceChild(container, textNode) ;

  const images = document.querySelectorAll("main img") ;
  if (images.length === 0) return ;

  images.forEach((img, i) => {
    const caption = img.alt || `Illustration ${i+1}` ;
    const id = img.id || `illustration-${i+1}` ;
    img.id = id ;

    const link = document.createElement("a") ;
    link.href = `#${id}` ;
    link.textContent = caption ;

    container.appendChild(link) ;
  }) ;
}

document.addEventListener("DOMContentLoaded", generateIllustrationIndex) ;