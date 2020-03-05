<template>
    <div class="col-4 mb-2 hover-image" v-show="isShowComponent">
        <div style="height: 150px">
            <h5 :style="imageBackground" v-show="isShowPercent">{{ textCenter }}</h5>
            <img :src="imageUrl" class="image" v-show="isShowImage">
            <div class="position-absolute t40l35" v-show="isShowSuccess">
                <button type="button" class="btn btn-info" v-on:click="pushImageUrlToParent" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-warning" v-on:click="notShowComponent"><i class="fas fa-trash-restore-alt"></i></button>
            </div>
            <div class="position-absolute t40l50 error" v-show="isShowError">
                <button type="button" class="btn btn-danger" v-on:click="notShowComponentError"><i class="fas fa-trash-restore-alt"></i></button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                textCenter: '',
                isShowPercent: true,
                isShowImage: false,
                isShowSuccess: false,
                isShowError: false,
                isShowComponent: true,
                imageBackground: {
                    textAlign: 'center',
                    lineHeight: '150px',
                },
                imageUrl: ''
            };
        },
        props: [
            'uploadFile'
        ],
        created() {
            let formData = new FormData();
            formData.append('file', this.uploadFile);

            axios
                .post('/gallery/image', formData, {
                    onUploadProgress: function ( progressEvent ) {
                        console.log(progressEvent.loaded + ' total : ' + progressEvent.total);
                        this.textCenter = Math.round((progressEvent.loaded / progressEvent.total) * 100) + ' %';
                    }.bind(this)
                })
                .then(function (response) {
                    if (response.status == 200) {
                        this.imageUrl = '/gallery/image/' + response.data.id;
                        this.isShowPercent = false;
                        this.isShowImage = true;
                        this.isShowSuccess = true;
                    } else {
                        this.isShowError = true;
                    }

                }.bind(this))
                .catch(function (error) {
                    this.isShowPercent = false;
                    this.isShowError = true;
            }.bind(this));
        },
        methods: {
            pushImageUrlToParent() {
                this.$emit('pushImageUrlToParent', this.imageUrl);
            },
            notShowComponent() {
                console.log('destroyed!');
                axios
                    .delete(this.imageUrl)
                    .then(function () {
                        this.isShowComponent = false;
                    }.bind(this))
            },
            notShowComponentError() {
                this.isShowComponent = false;
            }
        }
    }
</script>
<style>
    .t40l35 {
        top: 40%;
        left: 35%;
    }
    .t40l50 {
        top: 40%;
        left: 50%;
    }
    .image {
        width: 100%;
        height: 100%;
        max-height: 150px;
    }
    .hover-image img{
        opacity: 1;
    }
    .hover-image:hover img{
        opacity: 0.3;
    }
    .hover-image:hover button{
        opacity: 1;
        display: unset;
    }
    .hover-image button{
        opacity: 1;
        display: none;
    }
</style>
