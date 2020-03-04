<template>
    <div class="container">
        <div class="row mb-2">
            <dropzone-component v-on:pushFileToParent="getFile"></dropzone-component>
        </div>
        <div class="row">
            <image-component v-for="(uploadFile, index) in uploadFiles" :uploadFile="uploadFile" :key="index" v-on:pushImageUrlToParent="getImageUrl"></image-component>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <img :src="imageUrl" width="100%" height="auto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                uploadFiles: [],
                imageUrl: ''
            }
        },
        methods: {
            getFile(file) {
                this.uploadFiles.push(file);
            },
            getImageUrl(imageUrl) {
                this.imageUrl = imageUrl;
            }
        }
    }
</script>
