const mergeFile = {};
const mergeFileElement = document.getElementById('mergeFile');
const gallery_template = document.getElementById('gallery_template');
const gallery_row = document.getElementById('gallery_row');
const form_target = document.getElementById('form_target');

const files_input = (e) => {
    source = e.target;



    gallery = source.getAttribute('gallery');

    if (!mergeFile[gallery]) {
        mergeFile[gallery] = [];
    }


    const target = document.getElementById('gallery_' + gallery);


    const gallery_image_template = document.getElementById('gallery_image_template').cloneNode(true);

    const gallery_modal_template = document.getElementById('gallery_modal_template').cloneNode(true);

    files = source.files;
    
    for (let i = 0; i < files.length; i++) {

        //add file in merge files array
        for (let a = 0; a < files.length; a++) {
            
            for (var b = 0; b < mergeFile[gallery].length; b++) {
                if (mergeFile[gallery][b].name == files.item(a).name) break;
            }

            if (!(b < mergeFile[gallery].length)) {

                // el = document.createElement('input');
                // el.name = "gambar[" + gallery + "][]";
                // el.type = 'file';
                // el.classList.add('d-none');

                mergeFile[gallery].push(files.item(a))

            };

        }



        // console.log(mergeFile);

        gallery_col = gallery_image_template.cloneNode(true);

        modal = gallery_modal_template.cloneNode(true);

        gallery_col.setAttribute("nama_gambar", files.item(i).name);
        gallery_col.id = "";

        modal.id = "gallery_" + gallery + (target.childElementCount / 2);

        modal_image = modal.querySelector("div > div > div > img");
        modal_image.src = URL.createObjectURL(files[i]);

        gallery_col_button = gallery_col.querySelector("a");
        gallery_col_button.setAttribute('data-target', "#" + modal.id);
        
        delete_button = gallery_col_button.nextElementSibling.querySelector('button');
        delete_button.setAttribute('gallery', gallery);
        $(delete_button).on('click', button_delete);

        gallery_col_image = gallery_col.querySelector("a > img");
        gallery_col_image.src = modal_image.src;


        target.appendChild(gallery_col);

        target.appendChild(modal);
    }

    // assign mergeFile contain to hidden input files
    // mergeFileElement.files = createFileList(mergeFile);

    //set event on new created elements
    // button_delete();
}

const add_gallery = (e) => {

    source = e.target;
    tambah_button = source.nextElementSibling.children[0];

    if (!source.value) return;

    $(tambah_button).on('click', () => {
        $(source).change();
    });

    if (e.which == 13) {

        for (let i = 0; i < gallery_row.childElementCount; i++) {
            title = gallery_row.children[i].querySelector('div > div > div > div > h4');
            if (title.innerText == source.value) return;
        }

        element = gallery_template.cloneNode(true);
        element.id = "";

        galleryElement = element.querySelector("div > div.card-body > div");
        galleryElement.id = "gallery_" + source.value;

        title = element.querySelector('div > div > div > div > h4');
        title.innerText = source.value

        input = element.querySelector('div > div > div > div.text-right > input');

        $(input).on('change', files_input);

        input.setAttribute('gallery', source.value);

        gallery_row.appendChild(element);
    }

}

$("#tambah_gallery").on('keypress', add_gallery);

$(document.getElementById('tambah_gallery').nextElementSibling.children[0]).on('click', () => {
    $("#tambah_gallery").keypress();
});

const button_delete = () => {
    $('button[set=delete]').on('click', function(e) {
        source = e.target;

        gallery = source.getAttribute('gallery');

        col_gallery = source.parentElement.parentElement;

        console.log(col_gallery);

        if (source.getAttribute('gambar_id')) {

            input = document.createElement("input");
            input.type = "hidden";
            input.name = "delete_image[]";
            input.value = source.getAttribute('gambar_id');

            form_target.appendChild(input);

        } else {

            nama_gambar = col_gallery.getAttribute("nama_gambar");
            
            for (let i = 0; i < mergeFile[gallery].length; i++) {
                if (mergeFile[gallery][i].name === nama_gambar) {
                    mergeFile[gallery].splice(i, 1);
                    break;
                }
            }

        }

        col_gallery.nextElementSibling.remove();
        col_gallery.remove();

    });
}

const createFileList = (files) => {

    const fileList = new DataTransfer();

    for (let c = 0; c < files.length; c++) {
        fileList.items.add(files[c]);
    }
    // DataTransfer files property is FileList object
    return fileList.files;
}

$("#save_gallery").on('click', (e) => {

    e.preventDefault()

    mergeFileKey = Object.keys(mergeFile);

    for (let a = 0; a < mergeFileKey.length; a++) {

        if (element = form_target.querySelector("#file_" + mergeFileKey[a])) {
            element.files = createFileList( mergeFile[ mergeFileKey[a] ] );

        } else {
            element = document.createElement('input');
            element.id = "file_" +  mergeFileKey[a];
            element.type = "file";
            element.multiple = true;
            element.files = createFileList ( mergeFile[ mergeFileKey[a] ] );
            element.name = "gambar[" + mergeFileKey[a] + "][]";
            element.classList.add('d-none');

            form_target.appendChild(element);
        }

    }


    form_target.submit();    
});


