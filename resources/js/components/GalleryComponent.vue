<template>
    <div class="container">
        <div class="row mb-2">
            <dropzone-component v-on:pushFileToParent="getFile"></dropzone-component>
        </div>
        <div class="row">
            <image-component v-for="(uploadFile, index) in uploadFiles" :uploadFile="uploadFile" :key="index"></image-component>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                uploadFiles: []
            }
        },
        methods: {
            getFile(file) {
                this.uploadFiles.push(file);
            }
        }
    }
</script>
