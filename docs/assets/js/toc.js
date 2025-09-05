document.addEventListener("DOMContentLoaded", () => {
  const tocContainer = document.getElementById("toc") ;
  if (!tocContainer) return ;

  const headers = document.querySelectorAll("h1, h2, h3, h4") ;
  if (headers.length === 0) return ;

  const ul = document.createElement("ul") ;

  headers.forEach(header => {
    if (!header.id) {
      header.id = header.textContent.trim().toLowerCase()
        .replace(/[^\w]+/g, "-") ;
    }

    const li = document.createElement("li") ;
    li.className = header.tagName.toLowerCase() ;
    const a = document.createElement("a") ;
    a.href = `#${header.id}` ;
    a.textContent = header.textContent ;
    li.appendChild(a) ;
    ul.appendChild(li) ;
  }) ;
  
  tocContainer.appendChild(ul) ;
}) ;