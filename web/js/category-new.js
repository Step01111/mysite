let formNewCategory = document.getElementById('new_category');

SendNewCategory = function()
{
    let name = formNewCategory.category_name.value;
    if (!name) {
        alert('Укажите название статьи');
        return;
    }

    let alias = NameTranslit(name);

    let request = {
        name: name,
        alias: alias,
    };
    
    SendForm('/api/categories/create', request)
    .then(function(responseOb) {
        if (responseOb.ok) {
            location = '/categories/' + responseOb.artId + '/edit';
        } else {
            alert(responseOb.error);
        }
    });
}

formNewCategory.send.onclick = SendNewCategory;