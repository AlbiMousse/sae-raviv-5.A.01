function generateTOC() {
  const toc = document.getElementById("toc") ;
  if (!toc) return ;

  toc.innerHTML = "" ;

  const headers = document.querySelectorAll("main h1, main h2, main h3, main h4") ;
  if (headers.length === 0) return ;

  const list = document.createElement("ul") ;

  headers.forEach(h => {
    const id = h.id || h.textContent.trim().toLowerCase().replace(/\s+/g, "-") ;
    h.id = id ;

    const li = document.createElement("li") ;
    li.style.marginLeft = `${(parseInt(h.tagName[1]) - 1) * 10}px` ;

    const link = document.createElement("a") ;
    link.href = `#${id}` ;
    link.textContent = h.textContent ;

    li.appendChild(link) ;
    list.appendChild(li) ;
  }) ;

  toc.appendChild(list) ;
}

document.addEventListener("DOMContentLoaded", generateTOC) ;

const main = document.querySelector("main") ;
if (main) {
  const observer = new MutationObserver(() => generateTOC()) ;
  observer.observe(main, { childList: true, subtree: true }) ;
}