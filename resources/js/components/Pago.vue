<template>
  <main class="main">
    <div class="modal-body">
      <a href="http://www.placetopay.com" target="_blank">
        <img
          src="https://dev.placetopay.com/web/wp-content/uploads/2020/03/p2p-logo-default.svg"
          style="width :126px"
          alt
        />
      </a>
      <form action method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
          <div class="col-md-9">
            <input type="text" v-model="nombre" class="form-control" placeholder="Nombre" />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">apellido</label>
          <div class="col-md-9">
            <input type="text" v-model="apellido" class="form-control" placeholder="apellido" />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">cedula</label>
          <div class="col-md-9">
            <input type="text" v-model="cedula" class="form-control" placeholder="cedula" />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">Correo</label>
          <div class="col-md-9">
            <input type="email" v-model="correo" class="form-control" placeholder="Correo" />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
          <div class="col-md-9">
            <input type="number" v-model="telefono" class="form-control" placeholder="Telefono" />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">Total a Pagar</label>
          <div class="col-md-9">
            <input type="number" v-model="totalpagar" class="form-control" placeholder="cop" />
          </div>
        </fieldset>
        <!-- <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">login</label>
          <div class="col-md-9">
            <input type="text" v-model="login" class="form-control" placeholder="Marca" disabled />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">tranKey</label>
          <div class="col-md-9">
            <input type="text" v-model="tranKey" class="form-control" placeholder="Marca" disabled />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">nonce</label>
          <div class="col-md-9">
            <input type="text" v-model="nonce" class="form-control" placeholder="Marca" disabled />
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label class="col-md-3 form-control-label" for="text-input">seed</label>
          <div class="col-md-9">
            <input type="text" v-model="seed" class="form-control" placeholder="Marca" disabled />
          </div>
        </fieldset>-->
      </form>
    </div>
    <div class="modal-footer">
      <a href="http://www.placetopay.com" target="_blank">
        <img src="https://dev.placetopay.com/web/wp-content/uploads/2020/03/p2p-logo-dark.svg" alt />
      </a>
      <button type="button" class="btn btn-primary" @click="registrarPago()">Pagar</button>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      vehiculos_id: 0,
      nombre: "",
      correo: "",
      apellido: "",
      telefono: "",
      cedula: "",
      totalpagar: 0,
      arrayPersona: [],
      lista: [],
      login: "",
      nonce: "",
      tranKey: "",
      seed: "",
      enviar: "",
      text: ""
    };
  },

  methods: {
    registrarPago() {
      swal({
        title: "Esta seguro que desea realiar el pago?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          axios
            .post("/pago/registrar", {
              nombre: this.nombre,
              correo: this.correo,
              telefono: this.telefono,
              apellido: this.apellido,
              cedula: this.cedula,
              totalpagar: this.totalpagar
            })
            .then(function(response) {
              var respuesta = response.data;
              me.arrayPersona = respuesta.auth;

              me.enviar = JSON.stringify(me.arrayPersona);
              me.login = me.arrayPersona.login;
              me.tranKey = me.arrayPersona.tranKey;
              me.nonce = me.arrayPersona.nonce;
              me.seed = me.arrayPersona.seed;

              me.text =
                '{  "buyer": {    "name":"' +
                me.nombre +
                '"  ,    "surname":" ' +
                me.apellido +
                '",    "email":" ' +
                me.correo +
                '",    "document": "' +
                me.cedula +
                '",    "documentType": "CC",    "mobile": ' +
                me.telefono +
                "  }, ";
              me.text +=
                '"payment": {    "reference": "TEST_20200416_113953",    "description": "Rerum ullam nisi quae voluptatem asperiores illo.",  ';
              me.text +=
                ' "amount": {      "currency": "COP",      "total": ' +
                me.totalpagar +
                '   }  },  "expiration": "2020-04-17T11:39:53-05:00",  "ipAddress": "190.84.119.98",  "returnUrl": "http://127.0.0.1:8000/",  "userAgent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36",  "paymentMethod": null,  ';
              me.text += '"auth":' + me.enviar + " }";
              me.enviardata(me.text);
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });

      //Swal.fire("Any fool can use a computer");
    },
    enviardata(text) {
      var xhr = new XMLHttpRequest();
      var url = "https://test.placetopay.com/redirection/api/session/";
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function() {
        if (xhr.status === 200) {
          var myObj = JSON.parse(xhr.responseText);
          var direcion = JSON.stringify(myObj.processUrl);
          window.open(myObj.processUrl);
        }
      };
      //var data = text;
      // console.log(data);
      xhr.send(text);
    }
  },
  mounted() {}
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
</style>
