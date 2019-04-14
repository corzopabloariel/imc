const ENTIDADES = {
    slider: {
        ATRIBUTOS: {
            image: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 1400x714",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            seccion: {TIPO:"TP_STRING",VISIBILIDAD:"TP_OCULTO"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"},
            texto: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE",FIELDSET:1,NOMBRE:"texto"}
        },
        JSON: {
            texto: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-2">/orden/</div>',
                image: '<div class="col-6 col-md-5"><div class="custom-file">/image/</div></div>',
                BTN: '<div class="col-3 col-md-1">/BTN/</div>'
            },
            {
                texto: '<div class="col-12">/texto/</div>',
            }
        ],
        FUNCIONES: {
            image: {onchange:"readURL(this)"}
        }
    },
    cliente: {
        ATRIBUTOS: {
            image: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 1400x714",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            nombre: {TIPO:"TP_STRING",MAXLENGTH:100,VISIBILIDAD:"TP_VISIBLE"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"},
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-6">/orden/</div>',
                BTN: '<div class="col-6 col-md-6">/BTN/</div>',
            },
            {
                image: '<div class="col-12 my-1"><div class="custom-file">/image/</div></div>',
            },
            {
                nombre: '<div class="col-12">/nombre/</div>',
            }
        ],
        FUNCIONES: {
            image: {onchange:"readURL(this)"}
        }
    }
};