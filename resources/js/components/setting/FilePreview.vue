<template>
  <div>
    <div
      class="imagePreviewWrapper"
      :style="{
        'background-image': `url(${previewImage})`,
        'border-radius': '10px',
      }"
      @click="selectImage"
    >
      <div class="overlay">
        <div class="overlay-text bg-black text-white">Click to Edit</div>
      </div>
    </div>

    <input hidden ref="fileInput" type="file" @input="pickFile" />
  </div>
</template>

<script>
export default {
  props: ["existing"],
  data() {
    return {
      previewImage: null,
    };
  },
  methods: {
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
    setDefaultImage() {
      axios.get(route("upload.get_default")).then((response) => {
        this.previewImage = response.data.thumbnail;
      });
    },
  },
  mounted() {
    if (this.existing) {
      this.previewImage = this.existing.path.thumbnail;
    } else {
      this.setDefaultImage();
    }
  },
};
</script>

<style scoped>
.imagePreviewWrapper {
  width: 250px;
  height: 250px;
  display: block;
  cursor: pointer;
  margin: 0 auto 30px;
  position: relative;
  background-size: cover;
  background-position: center center;
}
.overlay{
 width:100%;
 height:100%;
    position:relative;
    top:0px;
    left:0px;
}

.overlay-text{
 margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  opacity: 0.4;
  transform: translate(-50%, -50%);
}


.overlay:hover {
    background: rgba(168, 168, 168, 0.253);
}

.overlay:hover .overlay-text {
     opacity: 1;
}
</style>
