

async function addToCart(product)
{
    //obtengo el id del producto
    //let id_button = $(product);
    let id = $(product).attr('attr').toString();

    const producto = await getProductRequest(id);


    addToCartWidget(producto, product);


}


function addToCartWidget(producto, button_cart)
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

        createDropDownItem(producto, drop_cart, button_cart);
        button_cart.disabled = true;



    } else {
        console.log(producto.result);
    }

}

function setButtonCart(id_button)
{

}


function createDropDownItem(producto, drop_cart, button_cart)
{
    producto = producto[0];
    let id_imte_cart = 'item_cart_' + button_cart.getAttribute('attr');

    let a = document.createElement('a');
    a.setAttribute("id", id_imte_cart)
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
    img.src = 'data:image/png;base64,' + producto.image;
    div_media.appendChild(img);

    //<div class="media-body">
    let div_mediabody = document.createElement('div');
    div_mediabody.classList.add('media-body');
    // <h3 class="dropdown-item-title">
    let h3 = document.createElement('h3');
    h3.classList.add('dropdown-item-title');
    h3.innerText = producto.name.toString();

    //console.log(producto);
    //<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
    let span_icon_delete = document.createElement('span');
    span_icon_delete.classList.add('float-right', 'text-sm', 'text-danger');
    span_icon_delete.setAttribute('attr', producto.idproductos);
    span_icon_delete.setAttribute('attr2', producto.cart_session[0].idcart_session);

    span_icon_delete.addEventListener("click", async function (e){
        await removeItemFromCart(span_icon_delete);
    });

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

async function removeItemFromCart(button_trash)
{
    console.log(button_trash);
    let id_cart_session = button_trash.getAttribute('attr2');
    let result = await deleteProductFromCartDB(id_cart_session);

    if(result.result){
        let id_button = 'button' + button_trash.getAttribute('attr');
        let btn_addToCart = document.getElementById(id_button);
        btn_addToCart.disabled = false;

        let badge_cart = document.getElementById("badge_cart");
        let cantidad_current = badge_cart.innerText === '' ? 0 : parseInt(badge_cart.innerText);
        cantidad_current--;
        badge_cart.innerHTML = cantidad_current.toString();

        button_trash.parentElement.parentElement.parentElement.parentElement.remove();
    }


}

async function removeItemFromCartTable(button_trash)
{
    alert(button_trash);

    let id_cart_session = button_trash.getAttribute('attr');
    let result = await deleteProductFromCartDB(id_cart_session);

    if(result.result){
        location.reload();
    }


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


const deleteProductRequest = async (id) => {
    let url = 'Productos/deleteProductFromCartSession';
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
            'idcartsession' : id,
        }),


    });
    if (!response.ok)
        throw new Error("WARN", response.status);

    return await response.json();

}
function deleteProductFromCartDB(id)
{
    return deleteProductRequest(id);

}


/** EVENTOS DE LOS FORMULARIOS**/


function setValueInput(element)
{
    element.setAttribute('value', Math.round(element.value));
    let is_descuento =  element.getAttribute('attr2');

    setPriceTotalResumeCart(element);
    setResultadosGenerales();

    if (is_descuento === 'descuento'){
        setTotalDescuentosUnitarios(element);
    } else {
        console.log(is_descuento);
    }



}

function setSubtotal(element)
{
    //obtengo la cantidad de productos
    let tabla_with_date_total = document.getElementById('tabla-responsive-total');
    let total_products = tabla_with_date_total.getAttribute('attr_cantidad');
    //console.log(total_products);
    //console.log('Los valores');

    let subtotal = 0;
    let total_descuentos = 0;
    let subtotal_item = 0;

    element.setAttribute('value', element.value);

    let id_control_file = parseInt(element.getAttribute('attr'));
    console.log('control: ' + id_control_file);
    for (let i = 1; i <= total_products; i++)
    {
        let input_precio_unidad = document.getElementsByName(i + '[precio_unidad]');
        let input_cantidad = document.getElementsByName(i + '[cantidad]');

        let descuento_unidad = document.getElementsByName(i + '[descuento_unidad]');



        if (input_precio_unidad[0] !== undefined)
        {
            let id_subcontrol = parseInt(input_precio_unidad[0].getAttribute('attr'));


            subtotal = subtotal + (parseFloat(input_precio_unidad[0].value) * input_cantidad[0].value);
            total_descuentos = total_descuentos + (parseFloat(descuento_unidad[0].value) * input_cantidad[0].value);
            //console.log(input_total[0].value);

            if (id_subcontrol === id_control_file){

                subtotal_item = subtotal_item + (parseFloat(input_precio_unidad[0].value) * input_cantidad[0].value -
                    (parseFloat(descuento_unidad[0].value) * input_cantidad[0].value));

                let total_item_input = document.getElementById('total_producto_' + id_control_file);
                total_item_input.value = subtotal_item.toFixed(2);
                total_item_input.setAttribute('value', subtotal_item.toFixed(2));
            }

        }


        subtotal_item = 0;


    }

    let subtotal_input = document.getElementById('subtotal');
    subtotal_input.value = subtotal.toFixed(2);
    subtotal_input.setAttribute('value', subtotal.toFixed(2));

    //modifico el total toal

    let descuento_input = document.getElementById('total_descuentos');
    descuento_input.value = total_descuentos.toFixed(2);
    descuento_input.setAttribute('value', total_descuentos.toFixed(2));


    //cambio el total por item
    //console.log(subtotal_item);
    let total_general = subtotal.toFixed(2) - total_descuentos.toFixed(2);

    let total_gen_input = document.getElementById('total_general');
    total_gen_input.value = total_general.toFixed(2);
    total_gen_input.setAttribute('value', total_general.toFixed(2));

}


function setDescuentoGeneral()
{

    let input_descuento = document.getElementById('descuento_general_input');

    let value = parseFloat(input_descuento.value);

    let input_descuento_general = document.getElementById('descuento_general');

    input_descuento_general.setAttribute('value', value);
    input_descuento_general.value = value;

    input_descuento.value = null;

    //seteo el total
    let input_subtotal = document.getElementById('subtotal');
    let input_total = document.getElementById('total_general');
    let total_general = parseFloat(input_subtotal.value) - value;

    input_total.setAttribute('value', total_general);
    input_total.value = total_general;


}

/** ADD ELEMENTO TO RESUMEN BOX CLIENTES**/

function addClienteToBoxPedido(element)
{

    let td_comercio = document.getElementById('td_comercio');
    let td_apellido = document.getElementById('td_apellido');
    let td_nombre = document.getElementById('td_nombre');
    let td_direccion = document.getElementById('td_direccion');
    let td_telefono = document.getElementById('td_telefono');
    let td_localidad = document.getElementById('td_localidad');

    let input_idcliente = document.getElementById('id_cliente');


    td_comercio.innerHTML = element.getAttribute('comercio').toString();
    td_apellido.innerHTML = element.getAttribute('apellido').toString();
    td_nombre.innerHTML = element.getAttribute('nombre').toString();
    td_direccion.innerHTML = element.getAttribute('direccion').toString();
    td_telefono.innerHTML = element.getAttribute('telefono').toString();
    td_localidad.innerHTML = element.getAttribute('localidad').toString();

    input_idcliente.value = element.getAttribute('id_cliente').toString();
    closeModalById('modal_clientes');

}


/* METODOS UTILIZADOS PARA LOS PEDIDOS*/


async function uploadProductByEmpleado(element)
{
    let div_parent = element.parentElement;
    let idempleado_comprastock = element.getAttribute('attr');

    let cantidad_input = document.getElementById('cantidad_' + idempleado_comprastock);



    let cantidad = cantidad_input.value;


    if (cantidad === undefined || cantidad === '') {
        alert('Complete el precio de compra');
    } else {


        let data = {
            'idempleado_comprastock' : idempleado_comprastock,
            'cantidad' : cantidad
        };



        let but = showButtonSync(element);
        let res = false;
        try {
            res = await uploadProductByEmpleadoDB(data);

        } finally {
            if(res.result === true ){
                setTimeout(function (){
                    location.reload();

                }, 5000);
            } else {
                // but.setAttribute('display', 'block');
                but.style.display = 'none';
                element.style.display = 'block';
                //showButtonSyncOk(div_parent);
                alert('No se puede almacenar. Intente nuevamente!');
            }

        }

    }

}






async function uploadProductByEmpleadoDB(array_data) {
    let url = '../uploadProductByEmpleado';
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
            array_data
        }),


    });

    return  await response.json();

}

function showButtonSync(element)
{
    let div_parent = element.parentElement;

    element.style.display = 'none';

    let button = document.createElement('button');
    button.classList.add('btn', 'btn-success', 'buttonload');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-spinner', 'fa-spin');
    button.appendChild(icon_trash);

    div_parent.appendChild(button);

    return button;

}

function showButtonSyncOk(div_parent)
{
    //let div_parent = element.parentElement;

    //element.remove();


    let button = document.createElement('button');
    button.classList.add('btn', 'btn-success');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-check');
    button.appendChild(icon_trash);

    div_parent.appendChild(button);

}

function showButtonUpdate(div_parent)
{
    //let div_parent = element.parentElement;

    //element.remove();

    let button = document.createElement('button');
    button.classList.add('btn', 'btn-warning');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-sync');
    button.appendChild(icon_trash);

    button.addEventListener('click', () => {
        uploadProductByEmpleado(this);
    });

    div_parent.appendChild(button);

}


/*** COMPRAS**/

function setTotalByProductoCompras(element)
{

    let element_type = element.getAttribute('attr2');
    let id = element.getAttribute('attr');

    let cantidad_input = document.getElementById('cantidad_' + id);
    let cantidad = parseInt(  cantidad_input.innerText === '' ||  cantidad_input.innerText === undefined ? 0 :   cantidad_input.innerText);



    if (element_type === 'precio'){

        let descuento_input = document.getElementById('descuento_unidad_' + id);
        let total_input = document.getElementById('total_' + id);

        let precio_value = element.value;
        let descuento_value = descuento_input.value;

        total_input.value = precio_value - descuento_value;
        //console.log(precio_value - descuento_value);
        //console.log(cantidad * precio_value);

        total_input.setAttribute('value', (cantidad * precio_value - cantidad * descuento_value));
        total_input.value = (cantidad * precio_value - descuento_value);

        //console.log(precio_value);
        //console.log(precio_value);




    } else if (element_type === 'descuento'){

        let precio_input = document.getElementById('precio_unidad_' + id);
        let total_input = document.getElementById('total_' + id);

        let descuento_value = element.value;
        let precio_value = precio_input.value;

        total_input.value = (cantidad * precio_value - cantidad * descuento_value);
        //console.log(precio_value - descuento_value);

        total_input.setAttribute('value', (cantidad * precio_value - descuento_value));

    }


}

async function aprobarProductoCompra(button)
{
    let res = confirm('Aprobar producto?');

    if(res){

        //traigo las variables
        let idempleado_comprastock = parseInt(button.getAttribute('attr'));
        let idproducto = parseInt(button.getAttribute('idproducto'));
        let idcomprastock = parseInt(button.getAttribute('idcomprastock'));
        let idproductos_comprasstock = parseInt(button.getAttribute('idproductos_comprasstock'));

        //traigo los valores de los inputs
        let precio_input = document.getElementById('precio_unidad_' + idproducto);
        let descuento_input = document.getElementById('descuento_unidad_' + idproducto);

        let cantidad_input = document.getElementById('cantidad_' + idproducto);

        let precio = parseFloat(precio_input.value);
        let descuento = parseFloat(descuento_input.value === '' || descuento_input.value === undefined ? 0 : descuento_input.value);

        let total = precio - descuento;

        let cantidad = parseInt(  cantidad_input.innerText === '' ||  cantidad_input.innerText === undefined ? 0 :   cantidad_input.innerText);

        if (isNaN(precio)){
            alert('El Precio No puede estar vacio');
        } else {
            showButtonUpdateCompra(button);
            //realizo el envio del producto
            const data = await aprobarProductoDB(idempleado_comprastock, idcomprastock, idproducto, idproductos_comprasstock, cantidad, precio, descuento);

            if (data.result){
                setTimeout(function (){
                    location.reload();

                }, 3000);
            }
        }


    }


}

async function desaprobarProductoCompra(button)
{
    let res = confirm('Desaprobar producto?');

    if(res){

        //traigo las variables

        let idempleado_comprastock = parseInt(button.getAttribute('idempleado_comprastock'));
        let idcomprastock = parseInt(button.getAttribute('idcomprastock'));

        showButtonDesaprobarCompra(button);
        const data = await desaprobarProductoDB(idcomprastock, idempleado_comprastock);
        if (data.result){
            setTimeout(function (){
                location.reload();

            }, 3000);
        }


    }

}

async function desaprobarProductoDB(idcomprastock, idempleado_comprastock){

    array_data = {
        idcomprastock : idcomprastock,
        idempleado_comprastock : idempleado_comprastock,
    }

    let url = '../desaprobarCompraNew';
    let headers = new Headers();


    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    headers.append('X-CSRF-Token', csrf);

    try {
        const response = await fetch(url, {
            method: 'POST',
            mode: 'same-origin',
            credentials: 'include',
            redirect: 'follow',
            headers: headers,
            body: JSON.stringify({
                array_data
            }),


        });

        const data =  await response.json();

        return Promise.resolve(data);



    } catch (e) {
        return Promise.reject(e);
    }

}


async  function aprobarProductoDB(idempleado_comprastock, idcomprastock, idproducto, idproductos_comprasstock, cantidad, precio, descuento)
{

    //tengo que traer el id de la compra


    array_data = {
        idempleado_comprastock : idempleado_comprastock,
        idcomprastock : idcomprastock,
        idproducto : idproducto,
        idproductos_comprasstock : idproductos_comprasstock,
        cantidad : cantidad,
        precio : precio,
        descuento :descuento
    }

    let url = '../aprobarCompraNew';
    let headers = new Headers();


    //const csrfToken = $.cookie('csrfToken');
    let csrf = $("meta[name='csrfToken']").attr("content");

    headers.append('Accept', 'application/json'); // This one is enough for GET requests
    headers.append('Content-Type', 'application/json'); // This one sends body
    headers.append('X-CSRF-Token', csrf);

    try {
        const response = await fetch(url, {
            method: 'POST',
            mode: 'same-origin',
            credentials: 'include',
            redirect: 'follow',
            headers: headers,
            body: JSON.stringify({
                array_data
            }),


        });

        const data =  await response.json();

        return Promise.resolve(data);



    } catch (e) {
        return Promise.reject(e);
    }

}


function showButtonUpdateCompra(element)
{
    let div_parent = element.parentElement;

    element.style.display = 'none';

    let button = document.createElement('button');
    button.classList.add('btn', 'btn-success', 'buttonload');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-spinner', 'fa-spin');
    button.appendChild(icon_trash);

    div_parent.appendChild(button);

    return button;


}

function showButtonDesaprobarCompra(element)
{
    let div_parent = element.parentElement;

    element.style.display = 'none';

    let button = document.createElement('button');
    button.classList.add('btn', 'btn-danger', 'buttonload');

    let icon_trash = document.createElement('i');
    icon_trash.classList.add('fas', 'fa-spinner', 'fa-spin');
    button.appendChild(icon_trash);

    div_parent.appendChild(button);

    return button;


}



function calculateUtility(input)
{

    let type_input = input.getAttribute('input');

    if(type_input === 'impuestos')
    {
        let impuesto_value = parseFloat(input.value);

        //obtengo los restantes elementos
        let utilidad_value = parseFloat(document.getElementById('utilidad').value === '' ? 0 : document.getElementById('utilidad').value);
        let precio_compra = parseFloat(document.getElementById('precio_informado').value);

        let precio_input = document.getElementById('precio');

        let impuesto_total = (precio_compra / 100 * impuesto_value);
        let utilidad_total = (precio_compra + impuesto_total) / 100 * utilidad_value;

        precio_input.value = precio_compra + impuesto_total + utilidad_total;


    }

    if(type_input === 'utilidad')
    {
        let utilidad_value = input.value;

        let impuesto_value = parseFloat(document.getElementById('impuestos').value === '' ? 0 : document.getElementById('impuestos').value);


        let precio_compra = parseFloat(document.getElementById('precio_informado').value);

        let precio_input = document.getElementById('precio');

        let impuesto_total = (precio_compra / 100 * impuesto_value);
        let utilidad_total = (precio_compra + impuesto_total) / 100 * utilidad_value;

        precio_input.value = precio_compra + impuesto_total + utilidad_total;

    }

}




