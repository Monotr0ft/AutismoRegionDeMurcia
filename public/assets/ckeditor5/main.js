const {
	ClassicEditor,
	Alignment,
	Autoformat,
	AutoImage,
	Autosave,
	BlockQuote,
	Bold,
	CodeBlock,
	Essentials,
	FindAndReplace,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
	GeneralHtmlSupport,
	Heading,
	Highlight,
	HorizontalLine,
	HtmlComment,
	HtmlEmbed,
	ImageBlock,
	ImageCaption,
	ImageInline,
	ImageInsert,
	ImageInsertViaUrl,
	ImageResize,
	ImageStyle,
	ImageTextAlternative,
	ImageToolbar,
	ImageUpload,
	Indent,
	IndentBlock,
	Italic,
	Link,
	LinkImage,
	List,
	ListProperties,
	MediaEmbed,
	Paragraph,
	PasteFromOffice,
	RemoveFormat,
	ShowBlocks,
	SimpleUploadAdapter,
	SourceEditing,
	SpecialCharacters,
	SpecialCharactersArrows,
	SpecialCharactersCurrency,
	SpecialCharactersEssentials,
	SpecialCharactersLatin,
	SpecialCharactersMathematical,
	SpecialCharactersText,
	Strikethrough,
	Style,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableProperties,
	TableToolbar,
	TextTransformation,
	Underline
} = window.CKEDITOR;

const LICENSE_KEY =
	'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzA3Njc5OTksImp0aSI6IjVkZGY1OGRlLTVkZDUtNGNlNy04N2Y5LWZlYjE3ODJkZGNhOSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6IjdjZTM4YzVjIn0.OMbfqfVtslwq-giG8S6WRCOpG5A7y1emc-cr1tK8C5LRWWK5FFKFsakZDWfl6-gvghs0GCpw8MzuLSzLNhvDHg';

// Definición de componentes Bootstrap para añadir al toolbar
const bootstrapComponents = [
	{
		name: 'insertBootstrapContainer',
		label: 'Contenedor Bootstrap',
		icon: 'container', // Deberías proporcionar un ícono adecuado
		command: 'insertBootstrapContainer'
	},
	{
		name: 'insertBootstrapRow',
		label: 'Fila Bootstrap',
		icon: 'row', // Deberías proporcionar un ícono adecuado
		command: 'insertBootstrapRow'
	},
	{
		name: 'insertBootstrapColumn',
		label: 'Columna Bootstrap',
		icon: 'column', // Deberías proporcionar un ícono adecuado
		command: 'insertBootstrapColumn'
	},
	{
		name: 'insertBootstrapCard',
		label: 'Tarjeta Bootstrap',
		icon: 'card', // Deberías proporcionar un ícono adecuado
		command: 'insertBootstrapCard'
	},
	{
		name: 'insertBootstrapAlert',
		label: 'Alerta Bootstrap',
		icon: 'alert', // Deberías proporcionar un ícono adecuado
		command: 'insertBootstrapAlert'
	}
];

// Definición de estilos de Bootstrap para el plugin Style
const bootstrapStyles = [
	// Texto
	{
		name: 'Texto principal',
		element: 'p',
		classes: ['lead']
	},
	{
		name: 'Texto muted',
		element: 'span',
		classes: ['text-muted']
	},
	{
		name: 'Texto primario',
		element: 'span',
		classes: ['text-primary']
	},
	{
		name: 'Texto secundario',
		element: 'span',
		classes: ['text-secondary']
	},
	{
		name: 'Texto éxito',
		element: 'span',
		classes: ['text-success']
	},
	{
		name: 'Texto peligro',
		element: 'span',
		classes: ['text-danger']
	},
	{
		name: 'Texto advertencia',
		element: 'span',
		classes: ['text-warning']
	},
	{
		name: 'Texto info',
		element: 'span',
		classes: ['text-info']
	},
	// Botones
	{
		name: 'Botón primario',
		element: 'a',
		classes: ['btn', 'btn-primary']
	},
	{
		name: 'Botón secundario',
		element: 'a',
		classes: ['btn', 'btn-secondary']
	},
	{
		name: 'Botón éxito',
		element: 'a',
		classes: ['btn', 'btn-success']
	},
	{
		name: 'Botón peligro',
		element: 'a',
		classes: ['btn', 'btn-danger']
	},
	{
		name: 'Botón advertencia',
		element: 'a',
		classes: ['btn', 'btn-warning']
	},
	{
		name: 'Botón info',
		element: 'a',
		classes: ['btn', 'btn-info']
	},
	{
		name: 'Botón light',
		element: 'a',
		classes: ['btn', 'btn-light']
	},
	{
		name: 'Botón dark',
		element: 'a',
		classes: ['btn', 'btn-dark']
	},
	// Contenedores
	{
		name: 'Contenedor',
		element: 'div',
		classes: ['container']
	},
	{
		name: 'Contenedor fluido',
		element: 'div',
		classes: ['container-fluid']
	},
	// Filas y columnas
	{
		name: 'Fila',
		element: 'div',
		classes: ['row']
	},
	{
		name: 'Columna (auto)',
		element: 'div',
		classes: ['col']
	},
	{
		name: 'Columna (6/12)',
		element: 'div',
		classes: ['col-6']
	},
	{
		name: 'Columna (4/12)',
		element: 'div',
		classes: ['col-4']
	},
	{
		name: 'Columna (3/12)',
		element: 'div',
		classes: ['col-3']
	},
	// Alertas
	{
		name: 'Alerta principal',
		element: 'div',
		classes: ['alert', 'alert-primary']
	},
	{
		name: 'Alerta secundaria',
		element: 'div',
		classes: ['alert', 'alert-secondary']
	},
	{
		name: 'Alerta éxito',
		element: 'div',
		classes: ['alert', 'alert-success']
	},
	{
		name: 'Alerta peligro',
		element: 'div',
		classes: ['alert', 'alert-danger']
	},
	{
		name: 'Alerta advertencia',
		element: 'div',
		classes: ['alert', 'alert-warning']
	},
	{
		name: 'Alerta info',
		element: 'div',
		classes: ['alert', 'alert-info']
	},
	// Cards
	{
		name: 'Tarjeta',
		element: 'div',
		classes: ['card']
	},
	{
		name: 'Cuerpo de tarjeta',
		element: 'div',
		classes: ['card-body']
	},
	{
		name: 'Título de tarjeta',
		element: 'h5',
		classes: ['card-title']
	},
	{
		name: 'Subtítulo de tarjeta',
		element: 'h6',
		classes: ['card-subtitle', 'text-muted']
	},
	{
		name: 'Texto de tarjeta',
		element: 'p',
		classes: ['card-text']
	},
	// Espaciado y márgenes
	{
		name: 'Margen pequeño',
		element: 'div',
		classes: ['m-2']
	},
	{
		name: 'Margen mediano',
		element: 'div',
		classes: ['m-3']
	},
	{
		name: 'Margen grande',
		element: 'div',
		classes: ['m-4']
	},
	{
		name: 'Padding pequeño',
		element: 'div',
		classes: ['p-2']
	},
	{
		name: 'Padding mediano',
		element: 'div',
		classes: ['p-3']
	},
	{
		name: 'Padding grande',
		element: 'div',
		classes: ['p-4']
	}
];

// Función para crear un plugin personalizado de Bootstrap
function createBootstrapPlugin(editor) {
	// Registrar comandos para insertar componentes Bootstrap
	editor.commands.add('insertBootstrapContainer', {
		execute: () => {
			editor.model.change(writer => {
				const container = writer.createElement('div', { class: 'container' });
				const paragraph = writer.createElement('paragraph');
				
				writer.append(paragraph, container);
				editor.model.insertContent(container);
			});
		}
	});

	editor.commands.add('insertBootstrapRow', {
		execute: () => {
			editor.model.change(writer => {
				const row = writer.createElement('div', { class: 'row' });
				const paragraph = writer.createElement('paragraph');
				
				writer.append(paragraph, row);
				editor.model.insertContent(row);
			});
		}
	});

	editor.commands.add('insertBootstrapColumn', {
		execute: () => {
			editor.model.change(writer => {
				const column = writer.createElement('div', { class: 'col' });
				const paragraph = writer.createElement('paragraph');
				
				writer.append(paragraph, column);
				editor.model.insertContent(column);
			});
		}
	});

	editor.commands.add('insertBootstrapCard', {
		execute: () => {
			editor.model.change(writer => {
				const card = writer.createElement('div', { class: 'card' });
				const cardBody = writer.createElement('div', { class: 'card-body' });
				const cardTitle = writer.createElement('h5', { class: 'card-title' });
				const cardText = writer.createElement('paragraph', { class: 'card-text' });
				
				writer.append(writer.createText('Título de la tarjeta'), cardTitle);
				writer.append(writer.createText('Contenido de la tarjeta...'), cardText);
				
				writer.append(cardTitle, cardBody);
				writer.append(cardText, cardBody);
				writer.append(cardBody, card);
				
				editor.model.insertContent(card);
			});
		}
	});

	editor.commands.add('insertBootstrapAlert', {
		execute: () => {
			editor.model.change(writer => {
				const alert = writer.createElement('div', { class: 'alert alert-primary' });
				const paragraph = writer.createElement('paragraph');
				
				writer.append(writer.createText('¡Esto es una alerta de Bootstrap!'), paragraph);
				writer.append(paragraph, alert);
				
				editor.model.insertContent(alert);
			});
		}
	});

	// Agregar botones a la barra de herramientas
	editor.ui.componentFactory.add('bootstrapComponents', locale => {
		const dropdownView = editor.ui.componentFactory.create('dropdown');
		
		dropdownView.buttonView.set({
			label: 'Bootstrap',
			tooltip: true,
			withText: true
		});

		// Llenar el dropdown con opciones para componentes de Bootstrap
		const buttons = bootstrapComponents.map(component => {
			const button = editor.ui.componentFactory.create('button');
			
			button.set({
				label: component.label,
				tooltip: true
			});

			// Conectar el botón con el comando correspondiente
			button.on('execute', () => {
				editor.execute(component.command);
				editor.editing.view.focus();
			});

			return button;
		});

		// Agregar los botones al dropdown
		dropdownView.on('render', () => {
			buttons.forEach(button => {
				dropdownView.panelView.children.add(button);
			});
		});

		return dropdownView;
	});
}


const editorConfig = {
	toolbar: {
		items: [
			'sourceEditing',
			'showBlocks',
			'findAndReplace',
			'|',
			'heading',
			'style',
			'|',
			'fontSize',
			'fontFamily',
			'fontColor',
			'fontBackgroundColor',
			'|',
			'bold',
			'italic',
			'underline',
			'strikethrough',
			'removeFormat',
			'|',
			'specialCharacters',
			'horizontalLine',
			'link',
			'insertImage',
			'mediaEmbed',
			'insertTable',
			'highlight',
			'blockQuote',
			'codeBlock',
			'htmlEmbed',
			'|',
			'alignment',
			'|',
			'bulletedList',
			'numberedList',
			'outdent',
			'indent'
		],
		shouldNotGroupWhenFull: true
	},
	plugins: [
		Alignment,
		Autoformat,
		AutoImage,
		Autosave,
		BlockQuote,
		Bold,
		CodeBlock,
		Essentials,
		FindAndReplace,
		FontBackgroundColor,
		FontColor,
		FontFamily,
		FontSize,
		GeneralHtmlSupport,
		Heading,
		Highlight,
		HorizontalLine,
		HtmlComment,
		HtmlEmbed,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsert,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		LinkImage,
		List,
		ListProperties,
		MediaEmbed,
		Paragraph,
		PasteFromOffice,
		RemoveFormat,
		ShowBlocks,
		SimpleUploadAdapter,
		SourceEditing,
		SpecialCharacters,
		SpecialCharactersArrows,
		SpecialCharactersCurrency,
		SpecialCharactersEssentials,
		SpecialCharactersLatin,
		SpecialCharactersMathematical,
		SpecialCharactersText,
		Strikethrough,
		Style,
		Table,
		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		TextTransformation,
		Underline,
		createBootstrapPlugin
	],
	simpleUpload: {
        uploadUrl: uploadUrl,
        withCredentials: true,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    },
	fontFamily: {
		supportAllValues: true
	},
	fontSize: {
		options: [10, 12, 14, 'default', 18, 20, 22],
		supportAllValues: true
	},
	heading: {
		options: [
			{
				model: 'paragraph',
				title: 'Paragraph',
				class: 'ck-heading_paragraph'
			},
			{
				model: 'heading1',
				view: 'h1',
				title: 'Heading 1',
				class: 'ck-heading_heading1'
			},
			{
				model: 'heading2',
				view: 'h2',
				title: 'Heading 2',
				class: 'ck-heading_heading2'
			},
			{
				model: 'heading3',
				view: 'h3',
				title: 'Heading 3',
				class: 'ck-heading_heading3'
			},
			{
				model: 'heading4',
				view: 'h4',
				title: 'Heading 4',
				class: 'ck-heading_heading4'
			},
			{
				model: 'heading5',
				view: 'h5',
				title: 'Heading 5',
				class: 'ck-heading_heading5'
			},
			{
				model: 'heading6',
				view: 'h6',
				title: 'Heading 6',
				class: 'ck-heading_heading6'
			}
		]
	},
	htmlSupport: {
		allow: [
			{
				name: /^.*$/,
				styles: true,
				attributes: true,
				classes: true
			},
			// Elementos específicos de Bootstrap
			{
				name: 'div',
				classes: [
					/^container(-fluid|-sm|-md|-lg|-xl|-xxl)?$/,
					/^row$/,
					/^col(-\d{1,2})?(-sm|-md|-lg|-xl|-xxl)?(-\d{1,2})?$/,
					/^alert(-\w+)?$/,
					/^card(-\w+)?$/,
					/^btn(-\w+)?$/,
					/^badge(-\w+)?$/,
					/^navbar(-\w+)?$/,
					/^d-\w+$/,
					/^m[trblxy]?-\d$/,
					/^p[trblxy]?-\d$/,
					/^text-\w+$/,
					/^bg-\w+$/,
					/^justify-content-\w+$/,
					/^align-items-\w+$/,
					/^rounded(-\w+)?$/,
					/^shadow(-\w+)?$/,
					/^position-\w+$/,
					/^border(-\w+)?$/,
					// Otros patrones de clases de Bootstrap
				]
			},
			{
				name: 'span',
				classes: [
					/^badge(-\w+)?$/,
					/^text-\w+$/,
					/^bg-\w+$/,
				]
			},
			{
				name: 'button',
				classes: [
					/^btn(-\w+)?$/,
				]
			},
			{
				name: 'a',
				classes: [
					/^btn(-\w+)?$/,
					/^nav-link$/,
					/^dropdown-item$/,
				]
			},
			{
				name: 'nav',
				classes: [
					/^nav$/,
					/^navbar$/,
					/^navbar-\w+$/,
				]
			},
			{
				name: 'ul',
				classes: [
					/^list-group$/,
					/^navbar-nav$/,
					/^nav$/,
				]
			},
			{
				name: 'li',
				classes: [
					/^list-group-item$/,
					/^nav-item$/,
				]
			},
			{
				name: 'table',
				classes: [
					/^table$/,
					/^table-\w+$/,
				]
			},
			{
				name: 'form',
				classes: [
					/^form$/,
					/^form-\w+$/,
				]
			},
			{
				name: 'input',
				classes: [
					/^form-control$/,
					/^form-check-input$/,
				]
			},
		]
	},
	style: {
		definitions: [
			// Estilos originales
			{
				name: 'Article category',
				element: 'h3',
				classes: ['category']
			},
			{
				name: 'Title',
				element: 'h2',
				classes: ['document-title']
			},
			{
				name: 'Subtitle',
				element: 'h3',
				classes: ['document-subtitle']
			},
			{
				name: 'Info box',
				element: 'p',
				classes: ['info-box']
			},
			{
				name: 'Side quote',
				element: 'blockquote',
				classes: ['side-quote']
			},
			{
				name: 'Marker',
				element: 'span',
				classes: ['marker']
			},
			{
				name: 'Spoiler',
				element: 'span',
				classes: ['spoiler']
			},
			{
				name: 'Code (dark)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-dark']
			},
			{
				name: 'Code (bright)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-bright']
			},
			// Agregar todos los estilos de Bootstrap definidos anteriormente
			...bootstrapStyles
		]
	},
	image: {
		toolbar: [
			'toggleImageCaption',
			'imageTextAlternative',
			'|',
			'imageStyle:inline',
			'imageStyle:wrapText',
			'imageStyle:breakText',
			'|',
			'resizeImage'
		]
	},
	language: 'es',
	licenseKey: LICENSE_KEY,
	link: {
		addTargetToExternalLinks: true,
		defaultProtocol: 'https://',
		decorators: {
			toggleDownloadable: {
				mode: 'manual',
				label: 'Downloadable',
				attributes: {
					download: 'file'
				}
			}
		}
	},
	list: {
		properties: {
			styles: true,
			startIndex: true,
			reversed: true
		}
	},
	placeholder: 'Empieza a escribir aquí...',
	style: {
		definitions: [
			{
				name: 'Article category',
				element: 'h3',
				classes: ['category']
			},
			{
				name: 'Title',
				element: 'h2',
				classes: ['document-title']
			},
			{
				name: 'Subtitle',
				element: 'h3',
				classes: ['document-subtitle']
			},
			{
				name: 'Info box',
				element: 'p',
				classes: ['info-box']
			},
			{
				name: 'Side quote',
				element: 'blockquote',
				classes: ['side-quote']
			},
			{
				name: 'Marker',
				element: 'span',
				classes: ['marker']
			},
			{
				name: 'Spoiler',
				element: 'span',
				classes: ['spoiler']
			},
			{
				name: 'Code (dark)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-dark']
			},
			{
				name: 'Code (bright)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-bright']
			}
		]
	},
	table: {
		contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
	}
};

// Código para cargar Bootstrap CSS (opcional)
function loadBootstrapCSS() {
    const bootstrapCSS = document.createElement('link');
    bootstrapCSS.rel = 'stylesheet';
    bootstrapCSS.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
    document.head.appendChild(bootstrapCSS);
}

// Cargar Bootstrap CSS si aún no está cargado
if (!document.querySelector('link[href*="bootstrap"]')) {
    loadBootstrapCSS();
}

ClassicEditor
    .create(document.querySelector('#editor'), editorConfig)
    .then(editor => {
        console.log('CKEditor con soporte de Bootstrap inicializado correctamente');
        
        // Opcional: Añadir un detector para detectar y formatear elementos Bootstrap al pegar contenido
        editor.editing.view.document.on('paste', (evt, data) => {
            // Aquí podrías añadir lógica para detectar y formatear correctamente
            // elementos de Bootstrap cuando se pega contenido
        });
    })
    .catch(error => {
        console.error('Error al inicializar CKEditor:', error);
    });
