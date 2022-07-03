<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'pa_ses' => [
        'name' => 'Países',
        'index_title' => 'Listado de Países',
        'new_title' => 'Nuevo País',
        'create_title' => 'Añadir País',
        'edit_title' => 'Editar País',
        'show_title' => 'Datos de Países',
        'inputs' => [
            'name' => 'Pais',
        ],
    ],

    'ciudades' => [
        'name' => 'Ciudades',
        'index_title' => 'Listado de ciudades / municipios',
        'new_title' => 'Nueva Ciudad',
        'create_title' => 'Añadir ciudad',
        'edit_title' => 'Editar Ciudad',
        'show_title' => 'Mostrar datos de ciudad',
        'inputs' => [
            'name' => 'Ciudad',
            'department_id' => 'Departamento',
        ],
    ],

    'departamentos' => [
        'name' => 'Departamentos',
        'index_title' => 'Lista de Departamentos',
        'new_title' => 'Nuevo Departamento',
        'create_title' => 'Crear Departamento',
        'edit_title' => 'Editar Departamento',
        'show_title' => 'Mostrar datos del Departamento',
        'inputs' => [
            'name' => 'Departamento',
            'country_id' => 'País',
        ],
    ],

    'niveles_acad_micos' => [
        'name' => 'Niveles Académicos',
        'index_title' => 'Listar Niveles Académicos',
        'new_title' => 'Nuevo Nivel Académico',
        'create_title' => 'Crear Niveles Académicos',
        'edit_title' => 'Editar Niveles Académicos',
        'show_title' => 'Mostrar Niveles Académicos',
        'inputs' => [
            'name' => 'Nivel académico',
        ],
    ],

    'programas_acad_micos' => [
        'name' => 'Programas Académicos',
        'index_title' => 'Listar Programas Académicos',
        'new_title' => 'Nuevo Programa Académico',
        'create_title' => 'Crear Programa Académico',
        'edit_title' => 'Editar Programa Académico',
        'show_title' => 'Mostrar Programa Académico',
        'inputs' => [
            'name' => 'Programa',
            'snies_code' => 'Código SNIES',
            'acreditado' => 'Programa Acreditado',
            'credits' => 'Créditos',
            'numero_duracion' => 'Número Duración',
            'periodo_duracion' => 'Periodo Duración',
            'jornada' => 'Jornada',
            'precio' => 'Precio',
            'university_id' => 'Universidad',
            'basic_core_id' => 'Núcleo Básico',
            'academic_level_id' => 'Nivel Académico',
            'modality_id' => 'Modalidad',
            'education_level_id' => 'Nivel de formación',
        ],
    ],

    'dimensi_n_academia' => [
        'name' => 'Dimensión Academia',
        'index_title' => 'Listar dimensiones Academia',
        'new_title' => 'Nueva dimensión academia',
        'create_title' => 'Crear dimensión Academia',
        'edit_title' => 'Editar dimensión Academia',
        'show_title' => 'Mostrar indicadores de la Dimensión',
        'inputs' => [
            'plan_estudio' => 'Plan de Estudio',
            'recursos_academicos' => 'Recursos Académicos',
            'tecnologia' => 'Tecnología',
            'tamano_grupos' => 'Tamaño Grupos',
            'excelencia_profesores' => 'Excelencia Profesores',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'convenios' => [
        'name' => 'Convenios',
        'index_title' => 'Listado de convenios',
        'new_title' => 'Nuevo convenio',
        'create_title' => 'Crear convenio',
        'edit_title' => 'Editar convenio',
        'show_title' => 'Mostrar convenio',
        'inputs' => [
            'name' => 'Nombre del convenio',
            'duracion' => 'Duración',
            'representante' => 'Representante',
            'university_id' => 'Universidad',
            'tasa_interes' => 'Tasa de Interés',
            'tasa_descuento' => 'Tasa de descuento',
        ],
    ],

    'n_cleos_b_sicos_de_conocimiento' => [
        'name' => 'Núcleos Básicos de Conocimiento',
        'index_title' => 'Listado de Núcleos Básicos',
        'new_title' => 'Nuevo Núcleo Básico',
        'create_title' => 'Crear Núcleo Básico',
        'edit_title' => 'Editar Núcleo Básico',
        'show_title' => 'Mostrar Núcleo Básico',
        'inputs' => [
            'name' => 'Núcleo básico',
            'knowledge_area_id' => 'Área del conocimiento',
        ],
    ],

    'beneficios' => [
        'name' => 'Beneficios',
        'index_title' => 'Listado de beneficios',
        'new_title' => 'Nuevo beneficio',
        'create_title' => 'Crear beneficio',
        'edit_title' => 'Editar Beneficio',
        'show_title' => 'Mostrar beneficio',
        'inputs' => [
            'name' => 'Beneficio',
            'beca_id' => 'Beca',
        ],
    ],

    'comentarios' => [
        'name' => 'Comentarios',
        'index_title' => 'Listado de comentarios',
        'new_title' => 'Nuevo comentario',
        'create_title' => 'Crear comentario',
        'edit_title' => 'Editar comentario',
        'show_title' => 'Mostrar comentario',
        'inputs' => [
            'comment' => 'Comentario',
            'student_id' => 'Estudiante',
        ],
    ],

    'dimensi_n_internacionalizaci_n' => [
        'name' => 'Dimensión Internacionalización',
        'index_title' => 'Listado de dimensiones Internacionalización',
        'new_title' => 'Nueva dimensión internacionalización',
        'create_title' => 'Crear dimensión internacionalización',
        'edit_title' => 'Editar dimensión internacionalización',
        'show_title' => 'Mostrar dimensión internacionalización',
        'inputs' => [
            'intercambios_movilidad' => 'Intercambios y Movilidad',
            'facilidad_acceso' => 'Facilidad de Acceso',
            'relevancia_internacional' => 'Relevancia Internacional',
            'convenios_internacionales' => 'Convenios Internacionales',
            'segundo_idioma' => 'Segundo Idioma',
            'academic_program_id' => 'Progrma académico',
        ],
    ],

    'niveles_de_formaci_n' => [
        'name' => 'Niveles de Formación',
        'index_title' => 'Listado de niveles de formación',
        'new_title' => 'Nuevo nivel de formación',
        'create_title' => 'Crear nivel de formación',
        'edit_title' => 'Editar nivel de formación',
        'show_title' => 'Mostrar nivel de formación',
        'inputs' => [
            'name' => 'Nivel de formación',
        ],
    ],

    'reas_de_conocimiento' => [
        'name' => 'Áreas de Conocimiento',
        'index_title' => 'Listado de Áreas de Conocimiento',
        'new_title' => 'Nueva Área de Conocimiento',
        'create_title' => 'Crear Área de Conocimiento',
        'edit_title' => 'Editar Área de Conocimiento',
        'show_title' => 'Mostrar Área de Conocimiento',
        'inputs' => [
            'name' => 'Área de conocimiento',
        ],
    ],

    'dimensi_n_estilos_de_vida' => [
        'name' => 'Dimensión Estilos de Vida',
        'index_title' => 'Listado de Dimensiones: Estilos de Vida ',
        'new_title' => 'Nueva Dimensión Estilo de Vida',
        'create_title' => 'Crear Dimensión Estilo de Vida',
        'edit_title' => 'Editar Dimensión Estilo de Vida',
        'show_title' => 'Mostrar Dimensión Estilo de Vida',
        'inputs' => [
            'ambiente' => 'Ambiente en la U',
            'diversion_ocio' => 'Diversión y Ocio',
            'descanso_relax' => 'Descanso y Relax',
            'cultura_ecologica' => 'Cultura Ecológica',
            'servicio_estudiante' => 'Servicio al Estudiante',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'tipos_de_multimedia' => [
        'name' => 'Tipos De Multimedia',
        'index_title' => 'Listado de tipos multimedia',
        'new_title' => 'Nuevo tipo de multimedia',
        'create_title' => 'Crear tipo de multimedia',
        'edit_title' => 'Editar tipo de multimedia',
        'show_title' => 'Mostrar tipo de multimedia',
        'inputs' => [
            'type' => 'Tipo de multimedia',
        ],
    ],

    'modalidades' => [
        'name' => 'Modalidades',
        'index_title' => 'Listado de modalidades',
        'new_title' => 'Nueva modalidad',
        'create_title' => 'Crear modalidad',
        'edit_title' => 'Editar modalidad',
        'show_title' => 'Mostrar modalidad',
        'inputs' => [
            'name' => 'Modalidad',
        ],
    ],

    'dimensi_n_prestigio' => [
        'name' => 'Dimensión Prestigio',
        'index_title' => 'Listar Dimensión Prestigio',
        'new_title' => 'Nueva Dimensión Prestigio',
        'create_title' => 'Crear Dimensión Prestigio',
        'edit_title' => 'Editar Dimensión Prestigio',
        'show_title' => 'Mostrar Dimensión Prestigio',
        'inputs' => [
            'reputacion_institucional' => 'Reputación Institucional',
            'practicas_profesionales' => 'Prácticas Profesionales',
            'imagen_egresado' => 'Imagen del Egresado',
            'asociaciones_externas' => 'Asociaciones Externas',
            'bolsa_empleo' => 'Bolsa de Empleo',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'dimensi_n_campus_universitario' => [
        'name' => 'Dimensión Campus Universitario',
        'index_title' => 'Listado de dimensiones Campus',
        'new_title' => 'Nueva dimensión Campus',
        'create_title' => 'Creae Dimensión Campus',
        'edit_title' => 'Editar Dimensión Campus',
        'show_title' => 'Mostrar Dimensión Campus',
        'inputs' => [
            'conectividad' => 'Internet y Conectividad',
            'salones' => 'Salones',
            'laboratorios' => 'Laboratorios',
            'cafeterias_restaurantes' => 'Cafeterias y Restaurantes',
            'espacios_comunes' => 'Espacios Comunes',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'dimensi_n_presupuesto' => [
        'name' => 'Dimensión Presupuesto',
        'index_title' => 'Listado de dimensión Presupuesto',
        'new_title' => 'Nueva dimensión Presupuesto',
        'create_title' => 'Crear dimensión Presupuesto',
        'edit_title' => 'Editar dimensión Presupuesto',
        'show_title' => 'Mostrar dimensión Presupuesto',
        'inputs' => [
            'financiacion' => 'Financiación',
            'becas_auxilio' => 'Becas y Auxilios',
            'costos_calidad' => 'Costos vs Calidad',
            'costos_manutencion' => 'Costos de manutención',
            'costos_parqueadero' => 'Costos de parqueadero',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'rector_as' => [
        'name' => 'Rectorías',
        'index_title' => 'Listado de Rectorías',
        'new_title' => 'Nueva Rectoría',
        'create_title' => 'Crear Rectoría',
        'edit_title' => 'Editar Rectoría',
        'show_title' => 'Mostrar Rectoría',
        'inputs' => [
            'name' => 'Nombre',
            'last_name' => 'Apellidos',
            'position' => 'Posición',
            'image' => 'Imagen',
            'university_id' => 'Universidad',
        ],
    ],

    'requisitos' => [
        'name' => 'Requisitos',
        'index_title' => 'Listado de requisitos',
        'new_title' => 'Nuevo requisito',
        'create_title' => 'Crear requisito',
        'edit_title' => 'Editar requisito',
        'show_title' => 'Mostrar requisito',
        'inputs' => [
            'name' => 'Requisito',
            'beca_id' => 'Beca',
        ],
    ],

    'estudiantes' => [
        'name' => 'Estudiantes',
        'index_title' => 'Listado de estudiantes',
        'new_title' => 'Nuevo estudiante',
        'create_title' => 'Crear estudiante',
        'edit_title' => 'Editar estudiante',
        'show_title' => 'Mostrar estudiante',
        'inputs' => [
            'user_id' => 'Usuario',
            'academic_program_id' => 'Programa académico',
            'semestre' => 'Semestre',
        ],
    ],

    'usuarios' => [
        'name' => 'Usuarios',
        'index_title' => 'Listado de usuarios',
        'new_title' => 'Nuevo usuario',
        'create_title' => 'Crear usuario',
        'edit_title' => 'Editar usuario',
        'show_title' => 'Mostrar usuario',
        'inputs' => [
            'name' => 'Nombre y Apellidos',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'image' => 'Avatar',
        ],
    ],

    'dimensi_n_bienestar' => [
        'name' => 'Dimensión Bienestar',
        'index_title' => 'Listado de Dimensiones Bienestar',
        'new_title' => 'Nueva Dimensión Bienestar',
        'create_title' => 'Crear Dimensión Bienestar',
        'edit_title' => 'Editar Dimensión Bienestar',
        'show_title' => 'Mostrar Dimensión Bienestar',
        'inputs' => [
            'orientacion_psicologia' => 'Orientación y Psicología',
            'actividades_deportivas' => 'Actividades Deportivas',
            'actividades_culturales' => 'Actividades Culturales',
            'plan_covid19' => 'Plan Covid 19',
            'felicidad_entorno' => 'Felicidad y Entorno',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'dimensi_n_zonas' => [
        'name' => 'Dimensión Zonas',
        'index_title' => 'Listado de dimensiones Zonas',
        'new_title' => 'Nueva dimensión zonas',
        'create_title' => 'Crear dimensión zonas',
        'edit_title' => 'Editar dimensión zonas',
        'show_title' => 'Mostrar dimensión zonas',
        'inputs' => [
            'facilidad_transporte' => 'Facilidad de Transporte',
            'seguridad_zona' => 'Seguridad de la Zona',
            'opciones_parqueo' => 'Opciones de Parqueo',
            'opciones_vivir' => 'Opciones para Vivir',
            'opciones_comer' => 'Opciones para Comer',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'multimedias' => [
        'name' => 'Multimedias',
        'index_title' => 'Listado de multimedias',
        'new_title' => 'Nueva multimedia',
        'create_title' => 'Crear Multimedia',
        'edit_title' => 'Editar multimedia',
        'show_title' => 'Mostrar multimedia',
        'inputs' => [
            'name' => 'Multimedia',
            'university_id' => 'Universidad',
            'path' => 'ruta',
            'url' => 'Url',
            'media_type_id' => 'Tipo multimedia',
        ],
    ],

    'becas' => [
        'name' => 'Becas',
        'index_title' => 'Listar becas ',
        'new_title' => 'Nueva Beca',
        'create_title' => 'Crear beca',
        'edit_title' => 'Editar beca',
        'show_title' => 'Mostrar beca',
        'inputs' => [
            'name' => 'Beca',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'bonos' => [
        'name' => 'Bonos',
        'index_title' => 'Listar bonos',
        'new_title' => 'Nuevo bono',
        'create_title' => 'Crear bono',
        'edit_title' => 'Editar bono',
        'show_title' => 'Mostrar bono',
        'inputs' => [
            'name' => 'Bono',
            'academic_program_id' => 'Programa académico',
        ],
    ],

    'convenios_universidades' => [
        'name' => 'Convenios Universidades',
        'index_title' => 'Listar convenios',
        'new_title' => 'Nuevo convenio',
        'create_title' => 'Crear convenio',
        'edit_title' => 'Editar convenio',
        'show_title' => 'Mostrar convenio',
        'inputs' => [
            'title' => 'Título',
            'image' => 'Imagen',
            'about' => 'Descripción',
            'university_id' => 'Universidad',
        ],
    ],

    'universidades' => [
        'name' => 'Universidades',
        'index_title' => 'Listar universidades',
        'new_title' => 'Nueva universidad',
        'create_title' => 'Crer universidad',
        'edit_title' => 'Editar uiversidad',
        'show_title' => 'Mostrar universidad',
        'inputs' => [
            'name' => 'Nombre de la Universidad',
            'oficial' => 'Es oficial',
            'acreditada' => 'Está acreditada',
            'city_id' => 'Ciudad',
            'principal' => 'Es principal',
            'direccion' => 'Dirección Domicilio',
            'fundada_at' => 'Fecha de fundación',
            'egresados' => 'Egresados',
            'general_description' => 'Descripción general',
            'logo' => 'Logo',
            'url' => 'Web',
            'about_video_url' => 'Video promocional',
            'background_image' => 'Imagen de fondo',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
