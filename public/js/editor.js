tinymce.init({
    selector: 'textarea',
    menubar: 'file edit insert view format table tools help',
    menu: {
        edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
        insert: {title: 'Insert', items: 'link media | template hr'},
        view: {title: 'View', items: 'visualaid'},
        format: {title: 'Format', items: 'bold italic'},
    },
    quickbars_insert_toolbar: 'quickimage quicktable',
    valid_elements : 'a[href|target=_blank],strong/b,i,code,br',
    contextmenu: "link image imagetools table spellchecker"
});