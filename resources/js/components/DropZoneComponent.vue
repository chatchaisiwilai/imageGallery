<template>
    <div class="col">
        <div style="border-style: dashed; border-color: rgba(0, 0, 0, 0.1); height: 200px; text-align: center; padding-top: 50px"
             @drop.prevent="addFile" @dragover.prevent @click="clickAddFile">
            <i class="fas fa-upload fa-4x"></i>
            <h6 style="padding-top: 5px;">
                Drop files here or click to choose files.
            </h6>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            addFile(e) {
                let droppedFiles = e.dataTransfer.files;
                if(!droppedFiles) return;
                ([...droppedFiles]).forEach(f => {
                    this.$emit('pushFileToParent', f);
                });
            },
            clickAddFile() {

            }
        }
    }
</script>
