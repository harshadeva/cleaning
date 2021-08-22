<template>
  <div>
    <form @submit="submitForm">
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
                <div class="col-md-6 mt-2">
                  <file-preview
                    :existing="record.logo_path"
                    @input="changeFile"
                    ref="logoUpload"
                  ></file-preview>
                  <div class="col-md-12">
                      <h6 v-if="!nameChanged" class="text-danger">You have changed you company name.Are you sure?</h6>

                    <button v-if="nameChanged" type="submit" name="submit" class="btn btn-success">
                      Submit
                    </button>
                    <div v-if="!nameChanged">
                        <button  type="submit" name="submit" class="btn btn-danger">
                      Yes, Do It
                    </button>
                    <button @click="resetName"  name="submit" class="btn btn-success">
                     Cancel
                    </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["record"],
  data() {
    return {
        company_name:this.record.name,
      form: {
        name: this.record.name,
        file:null
      },
    };
  },
  computed:{
      nameChanged(){
          return this.company_name == this.form.name;
      }
  },
  methods: {
      resetName(){
          event.preventDefault();
          this.form.name = this.company_name;
      },
    changeFile(item) {
      this.form.file = item;
    },
    submitForm() {
      event.preventDefault();
      let data = new FormData();
      data.append("file", this.form.file);
      data.append("name", this.form.name);
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      axios.post(route("settings.store"), data, config).then((response) => {
        if (response.data.successMessage) {
        showSuccess(response.data.successMessage);
        setTimeout(() => {
              window.location.replace(
                route("home")
              );
            }, 2000);
        }
        if (response.data.errorMessage) {
          showError(response.data.errorMessage);
        }
      });
    },
  },
};
</script>
<style scoped>
.img-thumbnail {
  max-width: 200px;
  cursor: pointer;
}

.container {
  position: relative;
  width: 100%;
  max-width: 200px;
}

.container img {
  width: 100%;
  height: auto;
  border-radius: 10px;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
  opacity: 0.4;
}

.container .btn:hover {
  background-color: black;
  opacity: 1;
}
</style>

