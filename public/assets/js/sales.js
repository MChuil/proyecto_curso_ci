document.addEventListener("DOMContentLoaded", ()=>{
    //Select2 para buscar clientes
    $('#selectCustomer').select2({
        ajax: {
            url: '/inventario/public/buscar/cliente',
            type: 'get',
            dataType: 'json',
            data : function(params){
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                }
            }
            
        }
    });


    //Select2 para buscar Productos
    $('#selectProduct').select2({
        ajax: {
            url: '/inventario/public/buscar/producto',
            type: 'get',
            dataType: 'json',
            data : function(params){
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.title,
                            id: item.code
                        }
                    })
                }
            }
            
        }
    });
})

function selectCustomer(){
    const selectCustomer = document.querySelector("#selectCustomer")
    const id = selectCustomer.options[selectCustomer.selectedIndex].value
    document.querySelector("#customer_id").value = id
}