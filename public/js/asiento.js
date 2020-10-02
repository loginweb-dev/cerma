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
    computed: {
        totalDebe() {
            return this.form.items.reduce((carry, item) => {
                return carry + Number(item.debe)
            }, 0)
        },
        totalHaber() {
            return this.form.items.reduce((carry, item) => {
                return carry + Number(item.haber)
            }, 0)
        }
    },
    methods: {
       itemsarray(arrayDet){
           this.form.cuentas =arrayDet.map(function (obj) {
          return obj.id;
          });
        },
      remove: function(detalle) {
        const index =this.form.items.indexOf(detalle);
        this.form.items.splice(index, 1);
      },
      buscarCuenta: function(){
        let me=this;
        me.form.estado = '';
        var url= '/admin/planes_cuentas/buscarcuenta?filtro=' + me.form.codigobuscar;
        //var url= '/cerma/public/admin/planes_cuentas/buscarcuenta?filtro=' + me.form.codigobuscar;

        this.$http.get(url).then(function (response) {
            console.log(response)
            var respuesta= response.data;
             me.form.cuentas = respuesta.cuenta;

             if (me.form.cuentas.length>0){
              me.form.idcuenta=me.form.cuentas[0]['id'];
              me.form.codigo=me.form.cuentas[0]['code'];
              me.form.cuenta=me.form.cuentas[0]['name'];
              me.form.tipo=me.form.cuentas[0]['tipo'];

                //push al a los items
                me.form.items.push({
                    id: me.form.idcuenta,
                    //fecha: me.form.fecha,
                    codigo: me.form.codigo,
                    name: me.form.cuenta,
                    //glosa: me.form.glosa,
                    debe: me.form.debe,
                    haber: me.form.haber,
                    tipo: me.form.tipo
                });
                //me.itemsarray( me.form.cuentas);
                me.form.idcuenta=0;
                me.form.codigobuscar="";
                me.form.codigo='';
                me.form.tipo = '';
             }
             else{
              me.form.codigo='No existe tal cuenta';
              me.form.idcuenta=0;
              me.form.cuenta = '';
              me.form.tipo = '';
             }
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      agregarDetalle(){
        let me=this;
        me.form.items.push({
            id: me.form.idcuenta,
            //fecha: me.form.fecha,
            codigo: me.form.codigo,
            name: me.form.cuenta,
            debe: me.form.debe,
            haber: me.form.haber,
            tipo: me.form.tipo
        });
            //me.itemsarray( me.form.cuentas);
            me.form.idcuenta=0;
            me.form.codigobuscar="";
            me.form.codigo='';

      },
        encuentra(id){
          var sw=0;
          for(var i=0;i<this.form.items.length;i++){
              if(this.form.items[i].id==id){
                  sw=true;
              }
          }
          return sw;
      },
      listarCuentas (buscar,criterio){
        let me=this;
        //var url= '/cerma/public/admin/planes_cuentas/listarcuentas?buscar='+ buscar + '&criterio='+ criterio;
        var url= '/admin/planes_cuentas/listarcuentas?buscar='+ buscar + '&criterio='+ criterio;
       this.$http.get(url).then(function (response) {
           console.log(response.data)
            var respuesta= response.data;
            me.form.arrayCuentas = respuesta.data.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      agregarDetalleModal(data =[]){
        let me=this;

        me.form.items.push({
            id: data['id'],
            //fecha: me.form.fecha,
            codigo: data['code'],
            name: data['name'],
           // glosa: me.form.glosa,
            debe: me.form.debe,
            haber: me.form.haber,
            tipo: data['tipo']
        });
        //quitamos el item del arrayde cuenta
        const index =this.form.arrayCuentas.indexOf(data);
        this.form.arrayCuentas.splice(index, 1);

                //me.itemsarray( me.form1.tomos);

      },
        crearAsiento: function() {
            var url = '/admin/asientos';
            this.$http.post(url, {
                items: this.form.items,
                glosa: this.form.glosa
            }).then(res => {
                console.log(res);
                if(res.data && res.data.saved) {
                   toastr.success('Asiento creado con éxito');
                    this.limpiar();
                }
            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito'
            });
        },
        limpiar() {
            this.form.idcuenta=0;
            this.form.codigobuscar="";
            this.form.codigo='';
            this.form.glosa='';
            this.form.descripcion= '';
            this.form.items= [];
        }
    }
  })
