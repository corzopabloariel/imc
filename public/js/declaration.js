const ENTIDADES = {
    usuario: {
        ATRIBUTOS: {
            username: {TIPO:"TP_STRING",MAXLENGTH:30,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"usuario"},
            name: {TIPO:"TP_STRING",MAXLENGTH:100,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase",NOMBRE:"nombre"},
            password: {TIPO:"TP_PASSWORD",VISIBILIDAD:"TP_VISIBLE",NOMBRE:"contraseña"},
            is_admin: {TIPO:"TP_ENUM",VISIBILIDAD:"TP_VISIBLE",ENUM:{1:"Administrador",0:"Usuario"},NOMBRE:"Tipo",CLASS:"text-uppercase"},
        },
        FORM: [
            {
                name: '<div class="col-7 col-md-6">/name/</div>',
                is_admin: '<div class="col-5 col-md-4">/is_admin/</div>',
                BTN: '<div class="col-3 col-md-2">/BTN/</div>'
            },
            {
                username: '<div class="col-6">/username/</div>',
                password: '<div class="col-6">/password/</div>',
            }
        ],
    },
    clienteG: {
        ATRIBUTOS: {
            username: {TIPO:"TP_STRING",MAXLENGTH:30,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"usuario"},
            name: {TIPO:"TP_STRING",MAXLENGTH:100,NECESARIO:1,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-uppercase",NOMBRE:"nombre"},
            password: {TIPO:"TP_PASSWORD",VISIBILIDAD:"TP_VISIBLE",NOMBRE:"contraseña"},
            fecha: {TIPO:"TP_FECHA",VISIBILIDAD:"TP_VISIBLE",NOMBRE:"acceso hasta"}
        },
        FORM: [
            {
                name: '<div class="col-9 col-md-10">/name/</div>',
                BTN: '<div class="col-3 col-md-2">/BTN/</div>'
            },
            {
                username: '<div class="col-6">/username/</div>',
                password: '<div class="col-6">/password/</div>',
            },
            {
                fecha: '<div class="col-6">/fecha/</div>',
            }
        ],
    },
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
                image: '<div class="col-6 col-md-5">/image/</div>',
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
                image: '<div class="col-12 my-1">/image/</div>',
            },
            {
                nombre: '<div class="col-12">/nombre/</div>',
            }
        ],
        FUNCIONES: {
            image: {onchange:"readURL(this)"}
        }
    },
    rrhh: {
        ATRIBUTOS: {
            provincia: {TIPO:"TP_ENUM",VISIBILIDAD:"TP_VISIBLE",ENUM:{BA:"Buenos Aires",NQ:"Neuquén"}},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"},
            nombre: {TIPO:"TP_STRING",MAXLENGTH:50,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"nombre"},
            experiencia: {TIPO:"TP_STRING",MAXLENGTH:100,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"experiencia"},
            rango: {TIPO:"TP_STRING",MAXLENGTH:50,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"rango"},
            orientacion: {TIPO:"TP_STRING",MAXLENGTH:30,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"orientacion"}
        },
        JSON: {
            nombre: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            experiencia: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            rango: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            orientacion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-2">/orden/</div>',
                provincia: '<div class="col-6 col-md-4">/provincia/</div>',
                BTN: '<div class="col-3 col-md-1">/BTN/</div>'
            },
            {
                nombre: '<div class="col-12 col-md-6">/nombre/</div>',
                experiencia: '<div class="col-12 col-md-6">/experiencia/</div>'
            },
            {
                rango: '<div class="col-12 col-md-6">/rango/</div>',
                orientacion: '<div class="col-12 col-md-6">/orientacion/</div>'
            }
        ]
    },
    archivo: {
        ATRIBUTOS: {
            documento: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Documento seleccionado",INVALID:"Seleccione documento",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            nombre: {TIPO:"TP_STRING",MAXLENGTH:100,VISIBILIDAD:"TP_VISIBLE"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"}
        },
        JSON: {
            nombre: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            documento: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-2">/orden/</div>',
                BTN: '<div class="col-6 col-md-1">/BTN/</div>',
            },
            {
                documento: '<div class="col-md-6 col-12">/documento/</div>',
                nombre: '<div class="col-md-6 col-12">/nombre/</div>',
            }
        ]
    },
    familia: {
        ATRIBUTOS: {
            nombre: {TIPO:"TP_STRING",MAXLENGTH:100,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"}
        },
        JSON: {
            nombre: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-2">/orden/</div>',
                BTN: '<div class="col-6 col-md-1">/BTN/</div>',
            },
            {
                nombre: '<div class="col-12">/nombre/</div>',
            }
        ]
    },
    trabajo: {
        ATRIBUTOS: {
            nombre: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE"},
            empresa: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE"},
            ubicacion: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE"},
            volumen: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE"},
            familia_id: {TIPO:"TP_ENUM",VISIBILIDAD:"TP_VISIBLE",ENUM:null,NOMBRE:"familia de trabajo"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"},
            titulo: {TIPO:"TP_STRING",MAXLENGTH:150,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título"},
            descripcion: {TIPO:"TP_TEXT",MAXLENGTH:150,FIELDSET:1,EDITOR:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
            tiempo: {TIPO:"TP_STRING",MAXLENGTH:150,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"tiempo"},
        },
        JSON: {
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            tiempo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                orden: '<div class="col-6 col-md-2">/orden/</div>',
                nombre: '<div class="col-md-6 col-12">/nombre/</div>',
            },
            {
                empresa: '<div class="col-md-6 col-12">/empresa/</div>',
                ubicacion: '<div class="col-md-6 col-12">/ubicacion/</div>'
            },
            {
                volumen: '<div class="col-md-6 col-12">/volumen/</div>',
                familia_id: '<div class="col-md-6 col-12">/familia_id/</div>',
            },
            {
                titulo: '<div class="col-md-6 col-12">/titulo/</div>',
                tiempo: '<div class="col-md-6 col-12">/tiempo/</div>',
            },
            {
                descripcion: '<div class="col-12">/descripcion/</div>',
            }
        ]
    },
    trabajoimagen: {
        ATRIBUTOS: {
            image: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 612x396",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"}
        },
        FORM: [
            {
                image: '<div class="col-12">/image/</div>',
                orden: '<div class="col-12">/orden/</div>',
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    servicio: {
        ATRIBUTOS: {
            icon: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 96x210",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            iconText: {TIPO:"TP_STRING",VISIBILIDAD:"TP_INVISIBLE",DEFAULT:"0",NOMBRE:"iconText"},
            tipo: {TIPO:"TP_ENUM",VISIBILIDAD:"TP_VISIBLE",ENUM:{EMP:"Empresa",ALQ:"Alquiler de equipo"}},
            orden: {TIPO:"TP_STRING",MAXLENGTH:3,VISIBILIDAD:"TP_VISIBLE",CLASS:"text-center text-uppercase"}
        },
        FORM: [
            {
                orden: '<div class="col-12 col-lg-2 col-md-3">/orden/</div>',
                tipo: '<div class="col-12 col-lg-4 col-md-6">/tipo/</div>',
                BTN: '<div class="col-3 col-lg-2 col-md-3">/BTN/</div>'
            },
            {
                iconText: '/iconText/',
                icon: '<div class="col-12 col-lg-7 col-md-8">/icon/<p class="text-center mb-0">Imagen doble [Nomal / Inversa]</p></div>',
            },
        ],
        FUNCIONES: {
            tipo: {onchange:"cambioTipo(this)"},
            icon: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    servicioALQ: {
        ATRIBUTOS: {
            titulo: {TIPO:"TP_STRING",MAXLENGTH:150,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título"},
            descripcion: {TIPO:"TP_TEXT",EDITOR:1,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
        },
        JSON: {
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                titulo: '<div class="col-md-6 col-12">/titulo/</div>',
                descripcion: '<div class="col-md-6 col-12">/descripcion/</div>',
            }
        ],
    },
    servicioALQimg: {
        ATRIBUTOS: {
            image: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 612x396",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            descripcion: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
        },
        JSON: {
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                image: '<div class="col-12">/image/</div>',
                //titulo: '<div class="col-12">/titulo/</div>',
                descripcion: '<div class="col-12">/descripcion/</div>',
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    },
    servicioEMP: {
        ATRIBUTOS: {
            titulo: {TIPO:"TP_STRING",MAXLENGTH:150,FIELDSET:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título"},
            descripcion: {TIPO:"TP_TEXT",FIELDSET:1,EDITOR:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
        },
        JSON: {
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                titulo: '<div class="col-12 col-md-6">/titulo/</div>',
                descripcion: '<div class="col-12 col-md-6">/descripcion/</div>',
            }
        ]
    },
    servicioEMPdetalle: {
        ATRIBUTOS: {
            titulo: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título"},
        },
        JSON: {
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                titulo: '<div class="col-12">/titulo/</div>'
            }
        ]
    },
    servicioEMPseccion: {
        ATRIBUTOS: {
            titulo: {TIPO:"TP_STRING",MAXLENGTH:150,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"título"},
            descripcion: {TIPO:"TP_TEXT",FIELDSET:1,EDITOR:1,VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
        },
        JSON: {
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
            titulo: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            }
        },
        FORM: [
            {
                titulo: '<div class="col-12 col-md-6">/titulo/</div>',
                //BTN: {H:'<div class="col-6">/BTN/<div class="mt-2 row detalles"></div></div>',ONCLICK:"addDetalle(this)",NOMBRE:"detalle<i class='fas fa-plus ml-2'></i>",CLASS:"btn-block btn-dark text-uppercase text-center"}
            },
            {
                descripcion: '<div class="col-12">/descripcion/</div>'
            }
        ]
    },
    servicioEMPimagen: {
        ATRIBUTOS: {
            image: {TIPO:"TP_FILE",NECESARIO:1,VALID:"Archivo seleccionado",INVALID:"Seleccione archivo - 612x396",BROWSER:"Buscar",VISIBILIDAD:"TP_VISIBLE"},
            descripcion: {TIPO:"TP_TEXT",VISIBILIDAD:"TP_VISIBLE",NOMBRE:"descripción"},
        },
        JSON: {
            descripcion: {
                esp: "español",
                ing: "inglés",
                ita: "italiano"
            },
        },
        FORM: [
            {
                image: '<div class="col-12">/image/</div>',
            },
            {
                descripcion: '<div class="col-12">/descripcion/</div>'
            }
        ],
        FUNCIONES: {
            image: {onchange:{F:"readURL(this,'/id/')",C:"id"}}
        }
    }
};