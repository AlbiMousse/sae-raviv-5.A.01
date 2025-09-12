function generateIllustrationIndex() {
  const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
  let textNode = null;
  while (walker.nextNode()) {
    if (walker.currentNode.nodeValue.includes("% lof %")) {
      textNode = walker.currentNode;
      break;
    }
  }
  if (!textNode) return;

  // Remplace le texte trouvé par un conteneur
  const container = document.createElement("div");
  textNode.parentNode.replaceChild(container, textNode);

  // Récupère toutes les images dans <main>
  const images = document.querySelectorAll("main img");
  if (images.length === 0) return;

  // Crée la liste
  const list = document.createElement("ul");

  images.forEach((img, i) => {
    const caption = img.alt || `Illustration ${i+1}`;
    const id = img.id || `illustration-${i+1}`;
    img.id = id;

    const li = document.createElement("li");
    const link = document.createElement("a");
    link.href = `#${id}`;
    link.textContent = caption;

    li.appendChild(link);
    list.appendChild(li);
  });

  container.appendChild(list);
}

document.addEventListener("DOMContentLoaded", generateIllustrationIndex) ;