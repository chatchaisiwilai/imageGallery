<template>
    <div class="col">
        <div style="border-style: dashed; border-color: rgba(0, 0, 0, 0.1); height: 200px; text-align: center; padding-top: 50px"
             @drop.prevent="addFile" @dragover.prevent v-on:click="clickDropZone">
            <i class="fas fa-upload fa-4x"></i>
            <h6 style="padding-top: 5px;">
                Drop files here or click to choose files.
            </h6>
            <input type="file" ref="inputFile" multiple v-on:change="inputFileChange" v-show="false">
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            addFile(e) {
                let droppedFiles = e.dataTransfer.files;
                if (!droppedFiles) return;
                ([...droppedFiles]).forEach(f => {
                    this.$emit('pushFileToParent', f);
                });
            },
            inputFileChange(e) {
                if (e.type == 'change') {
                    let inputFiles = e.currentTarget.files;
                    if (!inputFiles) return;
                    ([...inputFiles]).forEach(f => {
                        this.$emit('pushFileToParent', f);
                    });
                    console.log('onfilechange');
                }
            },
            clickDropZone() {
                this.$refs.inputFile.click();
            }
        }
    }
</script>
