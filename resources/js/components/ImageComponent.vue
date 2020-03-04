<template>
    <div class="col-4 mb-2">
        <div style="height: 150px">
            <h5 style="text-align: center;line-height: 150px;" v-show="isShowPercent">{{ percent }}%</h5>
            <img :src="imageUrl" style="width: 100%;height: auto;max-height: 150px;">
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                percent: 0,
                isShowPercent: true,
                isShowImage: false,
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
                        this.percent = (progressEvent.loaded / progressEvent.total) * 100;
                    }.bind(this)
                })
                .then(function (response) {
                    this.isShowPercent = false;
                    this.isShowImage = true;
                    console.log(response);
                    this.imageUrl = '/gallery/image/' + response.data.id;
                }.bind(this));
        }
    }
</script>
