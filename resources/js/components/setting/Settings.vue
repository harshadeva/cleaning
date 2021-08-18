<template>
  <div>
    <div class="card m-b-30">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h6>Company Details</h6>
              </div>
              <div class="col-md-12">
                <label>Name</label>
                <input class="form-control" type="text" v-model="form.name" />
              </div>
              <div class="col-md-12">
                <label>Logo</label>
                <img alt="logo" :src="record.logo.path"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["record"],
  data() {
    return {
      form: {
        name: this.record.name,
      },
    };
  },
};
</script>
<style scoped>
.img-thumbnail {
  max-width: 200px;
  cursor: pointer;
}
</style>

