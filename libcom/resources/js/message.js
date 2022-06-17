import {genElement} from "./dom_helper";


export function addMessageTimeout(text, afterDelete) {
    let header = document.getElementsByTagName("header")[0]
    let message = genElement(header, "div", "", "message","prepend")
    let content = genElement(message, "div", text, "message-content")
    let time = setTimeout(() => {
        message.remove()
    }, afterDelete)

}
