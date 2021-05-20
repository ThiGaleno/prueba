<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="content">

        <form action="" id="form-products">
            @csrf
            <div class="input-control">
                <label for="user_name">Nombre del cliente</label>
                <input type="text" class="user_name" id="user_name" value="Thiago" name="user_name">
            </div>
            <div class="input-control">
                <label for="document_number">Cédula</label>
                <input type="text" class="document_number" id="document_number" value="1238182468" name="document_number">
            </div>
            <div class="input-control">
                <label for="products">Productos</label>
                <select name="products[]" id="products" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            onclick="addProduct(event)" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <div class="products-list-header">
                    <span class="header-name">Nombre</span>
                    <span>Quantidade</span>
                    <span>price</span>
                    <span>desconto</span>
                    <span>subtotal</span>
                    <span>ação</span>
                </div>
                <div class="products-list">

                </div>

            </div>

            <input type="submit" onclick="submit_form(event)" value="Enviar">
        </form>
    </div>
    <style>
        .content{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            width: 500px;

        }
        .input-control{
            display:flex;
            flex-direction: column;
            margin: 15px 0 ;
        }
        .products-list-header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 30px;
        }

        .products-list{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 20px 0 0 0;
        }
        .products-list div{
            display: flex;
            justify-content: space-between;
        }
        .products-list input[name="amount[]"]{
            width: 30px;
        }
        .header-name, .products-list select[name="products[]"]{
            width: 40%;
        }


    </style>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        let username = document.querySelector('form .user_name').value;
        let document_number = document.querySelector('form .document_number').value;
        let products_list = document.querySelector('.products-list')

        function addProduct(el){
                const btn_del = document.createElement("button")
                btn_del.innerText = 'deletar'
                btn_del.value = el.target.value
                btn_del.setAttribute('data-name', el.target.innerText)
                btn_del.addEventListener('click', function(event){
                    event.preventDefault()
                    const option = document.createElement("option")
                    option.setAttribute('data-price', el.target.dataset.price)
                    option.value = btn_del.value
                    option.innerText = btn_del.dataset.name
                    option.setAttribute('onclick', 'addProduct(event)')
                    const products_options = document.querySelector('#products')
                    products_options.appendChild(option)
                    btn_del.parentNode.remove()
                })
                const product = document.createElement("div")
                const name = document.createElement("select")
                const id_product = document.createElement("option")
                const price = document.createElement('span')
                const quantity = document.createElement("input")
                const discount = document.createElement('span')
                let subtotal = document.createElement('span')
                price.innerText = el.target.dataset.price
                price.classList.add('price');
                quantity.setAttribute('min', 1)
                quantity.setAttribute('type', 'number')
                quantity.value = 1;
                quantity.setAttribute('name', 'amount[]')
                quantity.classList.add('amount')
                name.setAttribute('type', 'text')
                name.setAttribute('name', 'products[]')
                id_product.innerText = el.target.innerText
                id_product.value = el.target.value;
                discount.innerText = 0
                discount.classList.add('discount')
                subtotal.innerText = price.innerText - discount.innerText
                subtotal.classList.add('subtotal')
                product.classList.add('product-'+el.target.value)
                name.appendChild(id_product)
                product.appendChild(name)
                product.appendChild(quantity)
                product.appendChild(price)
                product.appendChild(discount)
                product.appendChild(subtotal)
                product.appendChild(btn_del)
                products_list.appendChild(product);
                el.target.remove()
        }

        function submit_form(e){
            e.preventDefault();
            const data = $('#form-products').serialize()
            $(document).ready(function(){
                $.ajax({
                    url: '/cadastrar',
                    data:data
                }).done((data) => {
                    console.log(data)
                }).fail((data) => {
                    console.log(data)
                })
            });
        }
        $("#id").on('submit', function(e){
            e.preventDefault();
            let formEl = $(this);
            $.ajax({
                "url": formEl.attr('action'),
                "method": formEl.attr('method'),
                "data": formEl.serialize(),
            }).done((data) => {

            }).fail((data)=> {

            });
        })
    </script>

</body>
</html>
