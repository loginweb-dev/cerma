var app = new Vue({
    el: '#asiento',
    data: {
      isProcessing: false,
      form: {},
      errors: {}
    },
    created: function () {
      Vue.set(this.$data, 'form', _form);
    },
    mounted() {
      //this.itemsarray(this.form.cuentas);
    },
    methods: {
       itemsarray(arrayDet){
           this.form.cuentas =arrayDet.map(function (obj) {
          return obj.id;
          });
        },
      remove: function(detalle) {
        const index =this.form.cuentas.indexOf(detalle);
       //  const index2 =this.form.items.indexOf(detalle);
        this.form.items.splice(index, 1);
      },
      buscarCuenta: function(event){
        if (event) event.preventDefault()
        let me=this;
        me.form.estado = '';
        var url= '/admin/planes_cuentas/buscarcuenta?filtro=' + me.form.codigobuscar;

        this.$http.get(url).then(function (response) {
            var respuesta= response.data;
             me.form.cuentas = respuesta.cuenta;

             if (me.form.cuentas.length>0){
              me.form.codigo=me.form.cuentas[0]['sub_division'];
              me.form.cuenta=me.form.cuentas[0]['name'];
             }
             else{
              me.form.codigo='No existe tal cuenta';
              me.form.idcuenta=0;
              me.form.cuenta = '';
             }
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      agregarDetalle(){
        let me=this;
        if( me.form.idcuenta==0 || me.form.codigobuscar=='' ){
        }
        else{
            if(me.encuentra(me.form.idcuenta)){
                    Swal.fire({
                      type: 'error',
                      title: 'Error...',
                      text: 'Esta cuenta ya se encuentra agregada!',
                    })
            }
            else{
               me.form.cuentas.push({
                    id: me.form.idcuenta,
                    codigo: me.form.codigo
                });
                me.itemsarray( me.form.cuentas);
                me.form.idcuenta=0;
                me.form.codigobuscar="";
                me.form.codigo='';

            }
        }
      },
        encuentra(id){
          var sw=0;
          for(var i=0;i<this.form.cuentas.length;i++){
              if(this.form.cuentas[i].id==id){
                  sw=true;
              }
          }
          return sw;
      },
      listarCuentas (buscar,criterio){
        let me=this;
        var url= '/admin/planes_cuentas/listarcuentas?buscar='+ buscar + '&criterio='+ criterio;
       this.$http.get(url).then(function (response) {
            var respuesta= response.data;
            me.form.arrayCuentas = respuesta.data.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      agregarDetalleModal(data =[]){
        let me=this;
        if(me.encuentra(data['id'])){
                toastr.warning('Lo siento. Ese tomo ya se encuentra agregado!!')
            }
            else{
               me.form1.tomos.push({
                    id: data['id'],
                    codigo: data['codigo']
                });
                me.itemsarray( me.form1.tomos);
            }
      },
        submit() {
          document.forms['prestamosform'].submit();
        }
    }
  })
