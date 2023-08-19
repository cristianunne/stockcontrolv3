

async function addToCart(product)
{
    //obtengo el id del producto
    let id = $(product).attr('id').toString();

    const producto = await getProductRequest(id);

    addToCartWidget(producto);


}


function addToCartWidget(producto)
{
    if (producto.result === undefined)
    {
        //agrego al widget
        let drop_cart = document.getElementById("dropdown-cart");
        let badge_cart = document.getElementById("badge_cart");
        //let drop_cart = $("#dropdown-cart");
        //let badge_cart = $("#badge_cart");

        let cantidad_current = badge_cart.innerText === '' ? 0 : parseInt(badge_cart.innerText);

        cantidad_current++;

        badge_cart.innerHTML = cantidad_current.toString();

        createDropDownItem(producto, drop_cart);


    } else {
        console.log(producto.result);
    }

}


function createDropDownItem(producto, drop_cart)
{
    producto = producto[0];

    let a = document.createElement('a');
    let link = document.createTextNode("");
    a.appendChild(link);
    a.href = '#';
    a.classList.add("dropdown-item");


    let div_media = document.createElement('div');
    div_media.classList.add('media');


    //<img src="dist/img/user1-128x128.jpg" alt="User Avatar" className="img-size-50 mr-3 img-circle">
    let img = document.createElement('img');
    img.classList.add('img-size-50', 'mr-3', 'img-circle');
    img.alt = 'imagen cart'
    img.src = '/stockcontrolv3/' + producto.folder + producto.photo;
    div_media.appendChild(img);

    //<div class="media-body">
    let div_mediabody = document.createElement('div');
    div_mediabody.classList.add('media-body');
    // <h3 class="dropdown-item-title">
    let h3 = document.createElement('h3');
    h3.classList.add('dropdown-item-title');
    h3.innerText = producto.name.toString();

    //<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
    let span_icon_delete = document.createElement('span');
    span_icon_delete.classList.add('float-right', 'text-sm', 'text-danger');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-trash');

    span_icon_delete.appendChild(icon_trash);

    h3.appendChild(span_icon_delete);

    div_mediabody.appendChild(h3);

    //  <p class="text-sm">Call me whenever you can...</p>
    let p_marca = document.createElement('p');
    p_marca.innerText = producto.marca.toString();

    div_mediabody.appendChild(p_marca);

    div_media.appendChild(div_mediabody);
    a.appendChild(div_media);
    drop_cart.insertBefore(a, drop_cart.lastElementChild);

    // <div class="dropdown-divider"></div>-->

    let div_divider = document.createElement('div');
    div_divider.classList.add('dropdown-divider');
    drop_cart.insertBefore(div_divider, drop_cart.lastElementChild);


}


function showDropdownCart()
{
    let dropdown_cart = $("#dropdown-cart").toggle();

}


const getProductRequest = async (id) => {
    let url = 'Productos/getProductById';
    let headers = new Headers();


    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    headers.append('X-CSRF-Token', csrf);

    const response = await fetch(url, {
        method: 'POST',
        mode: 'same-origin',
        credentials: 'include',
        redirect: 'follow',
        headers: headers,
        body: JSON.stringify({
            'producto_id' : id,
        }),


    });
    if (!response.ok)
        throw new Error("WARN", response.status);
    const data = await response.json();

    return data;

}

