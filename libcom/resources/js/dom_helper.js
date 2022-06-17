export function genElement(parent, type, inner, classe = "",position="after") {
    let item = document.createElement(type);
    if (classe !== "") {
        item.classList.add(classe);
    }
    item.innerHTML = inner;
    if(position==="after"){

        parent.appendChild(item);
    }else{
        parent.prepend(item);
    }
    return item;
}
