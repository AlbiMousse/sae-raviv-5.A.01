function generateTOC() {
  const toc = document.getElementById("toc");
  if (!toc) return;

  toc.innerHTML = "";

  const headers = document.querySelectorAll("main h2, main h3, main h4");
  if (headers.length === 0) return;

  const rootList = document.createElement("ul");
  let currentLists = { 2: rootList, 3: null, 4: null };

  headers.forEach(h => {
    const level = parseInt(h.tagName[1]);
    const id = h.id || h.textContent.trim().toLowerCase().replace(/\s+/g, "-");
    h.id = id;

    const li = document.createElement("li");
    const button = document.createElement("button");
    button.textContent = h.textContent;
    button.onclick = () => location.hash = `#${id}`;

    li.appendChild(button);

    if (level > 2) {
      let parentLevel = level - 1;
      if (!currentLists[level]) {
        const newList = document.createElement("ul");
        newList.style.display = "none";
        currentLists[parentLevel].lastElementChild.appendChild(newList);

        const parentButton = currentLists[parentLevel].lastElementChild.querySelector("button");
        if (parentButton && !parentButton.dataset.hasToggle) {
          parentButton.dataset.hasToggle = "true";
          parentButton.onclick = () => {
            newList.style.display = newList.style.display === "none" ? "block" : "none";
          };
        }
        currentLists[level] = newList;
      }
      currentLists[level].appendChild(li);
    } else {
      rootList.appendChild(li);
      currentLists = { 2: rootList, 3: null, 4: null };
    }
  });

  toc.appendChild(rootList);
}

document.addEventListener("DOMContentLoaded", generateTOC);

const main = document.querySelector("main");
if (main) {
  const observer = new MutationObserver(() => generateTOC());
  observer.observe(main, { childList: true, subtree: true });
}