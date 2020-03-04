<template>
    <div class="col-4 mb-2">
        <div style="height: 150px">
            <h5 :style="imageBackground" v-show="isShowPercent">{{ textCenter }}</h5>
            <img :src="imageUrl" style="width: 100%;height: auto;max-height: 150px;" v-show="isShowImage">
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
                        this.isShowPercent = false;
                        this.isShowImage = true;
                        console.log(response);
                        this.imageUrl = '/gallery/image/' + response.data.id;
                    } else {
                        this.imageBackground.backgroundColor = red;
                    }

                }.bind(this));
        }
    }
</script>
