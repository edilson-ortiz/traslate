import './bootstrap';

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// Get a file input reference
const inputElment = document.querySelector('input[type="file"]');
const token = document.querySelector('input[name="_token"]');

FilePond.registerPlugin(FilePondPluginFileValidateType);


const pond = FilePond.create(inputElment,{
    acceptedFileTypes: [
        'audio/mpeg', // MP3
        'audio/wav',  // WAV
        'audio/aac',  // AAC
        'audio/flac', // FLAC
        'audio/ogg',  // OGG
        'audio/x-m4a' // M4A
    ],
});


FilePond.setOptions({
    server:{
        name:'audio',
        url:'/audio/upload',
        process:{
            method: 'POST',
            withCredentials: false,
            onload: (response) => {
                Livewire.dispatch('urlName', { url: response })
            },
        },
        revert: (uniqueFileId, load, error) => {
            Livewire.dispatch('urlName', { url: null })
            error('oh my goodness');
            load();
        },
        headers:{
            'X-CSRF-TOKEN':token.value
        },
    }
});

const limpiar = document.getElementById('limpiar');


Livewire.on('post-created', () => {
    pond.removeFile();
});
   


