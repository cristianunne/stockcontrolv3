

async function onChangedCategories(category)
{

    let cat_number = $(category).val();

    let action = category.getAttribute('attr');

    let categories = await getSubCategories(cat_number, action);

    if (categories !== undefined)
    {
        let list_POI_select = document.getElementById("subcategories_idsubcategories");
        list_POI_select.innerText = null;

        let claves = Object.keys(categories);

        for(let i=0; i < claves.length; i++){
            let clave = claves[i];

            list_POI_select.appendChild(new Option(categories[clave], clave));
        }
    }

    console.log(categories);
}



async function getSubCategories(category_select, action)
{



    let headers = new Headers();

    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    headers.append('X-CSRF-Token', csrf);

    let url_ = 'getSubCategoriesByCategory?category=' + category_select;
    let url_edit = '../getSubCategoriesByCategory?category=' + category_select;

    let url = action === 'edit' ? url_edit : url_;


    let data_ = null;
    /*let result = await fetch(url, {
        method: 'POST',
        mode: 'same-origin',
        credentials: 'include',
        redirect: 'follow',
        headers: headers,
        body: JSON.stringify({
            category: category_select,
        }),
    })
        .then(res => res.json())
        .then(data => {
            // enter you logic when the fetch is successful
            return data;
        })
        .catch(error => {
            // enter your logic for when there is an error (ex. error toast)
            console.log(error)
        });*/

    let result = await fetch(url)
        .then(res => res.json())
        .then(data => {
            // enter you logic when the fetch is successful
            return data;
        })
        .catch(error => {
            // enter your logic for when there is an error (ex. error toast)
            console.log(error)
        })
    return result;

}
