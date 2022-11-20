let formCategory = document.getElementById('form_category');

SendCategory = function()
{
    let id = formCategory.category_id.value;
    let name = formCategory.category_name.value;
    let alias = formCategory.alias.value;
    let title = formCategory.category_title.value;
    let description = formCategory.description.value;

    if (!name) {
        alert('Укажите название раздела');
        return;
        }

    let request = {
        id: id,
        name: name,
        alias: alias,
        title: title,
        description: description,
    };

    SendForm('/api/categories/edit', request)
    .then(function(responseOb) {
        console.log(responseOb);
        if (responseOb.ok) {
            alert('Изменения сохранены');
        } else {
            alert(responseOb.error);
        }
    });
}

formCategory.send.onclick = SendCategory;

formCategory.onkeydown = function (event) {
    if (event.keyCode == 13) {
        SendCategory();
    }
}