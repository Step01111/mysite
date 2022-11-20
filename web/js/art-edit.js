let formArt = document.getElementById('form_art');
let open = document.getElementById('open');

SendArt = function()
{
    let id = formArt.art_id.value;
    let name = formArt.art_name.value;
    let alias = formArt.alias.value;
    let title = formArt.art_title.value;
    let description = formArt.description.value;
    let text = formArt.text.value;

    if (!name) {
        alert('Укажите название статьи');
        return;
        }
    if (!text) {
        alert('Напишите текст статьи');
        return;
    }
    
    let request = {
        id: id,
        name: name,
        alias: alias,
        title: title,
        description: description,
        text: text,
    };

    SendForm('/api/art/edit', request)
    .then(function(responseOb) {
        console.log(responseOb);
        if (responseOb.ok) {
            let url = open.href.replace(/[^\/]+$/, request.alias);
            open.href = url;
            alert('Изменения сохранены');
        } else {
            alert(responseOb.error);
        }
    });
}

formArt.send.onclick = SendArt;

formArt.onkeydown = function (event) {
    if (event.keyCode == 13) {
        SendArt();
    }
}