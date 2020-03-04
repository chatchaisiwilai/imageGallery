<template>
    <div class="col-4 mb-2">
        <div style="height: 150px">
            <h5 :style="imageBackground" v-show="isShowPercent">{{ textCenter }}</h5>
            <img :src="imageUrl" class="image" v-show="isShowImage">
            <div class="position-absolute t40l35" v-show="isShowSuccess">
                <button type="button" class="btn btn-info" v-on:click="pushImageUrlToParent" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-warning"><i class="fas fa-trash-restore-alt"></i></button>
            </div>
            <div class="position-absolute t40l50 error" v-show="isShowError">
                <button type="button" class="btn btn-danger"><i class="fas fa-search"></i></button>
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
            console.log(this.uploadFile);

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
                        console.log(response);
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
        height: auto;
        max-height: 150px;
    }
</style>
