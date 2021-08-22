<template>
  <div>
    <form @submit="submitForm">
      <div class="card m-b-30">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Site</label>
                  <v-select
                    v-model="selected_data.site"
                    :options="siteArray"
                    @input="siteChanged"
                    label="name"
                  />
                </div>
                <div class="col-md-6">
                  <label>Date</label>
                  <input
                    type="date"
                    v-model="form.date"
                    class="form-control"
                    placeholder="Date"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="selected_data.site != null">
        <div
          v-for="(site_section, index) in this.form.site_sections"
          :key="index"
          class="card"
        >
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 pb-2">
                    <em class="fa fa-star pb-2"></em>
                    <span>{{ site_section.rating }}</span><span style="opacity:0.8"> / 10</span>
                    &nbsp; &nbsp;
                    <em class="fa fa-image pb-2"></em>
                    <span>{{ site_section.files.length }}</span>
                    &nbsp;
                    &nbsp;
                    <em class="fa fa-building"></em>
                    <span>{{ site_section.section_name }}</span>
                  </div>
                  <div class="col-md-5 pb-2" >
                    <em class="fa fa-user"></em>
                    <span>{{ site_section.employee_name }}</span>

                  </div>
                  <div class="col-md-3 d-flex flex-row justify-content-end">
                    <b-button
                      style="
                         {
                          outline: none;
                          box-shadow: none;
                        }
                      "
                      v-b-toggle="'collapse-' + index"
                      class="btn-top-margin btn toggle-btn-color"
                    >&nbsp;
                      <span v-if="site_section.expanded">
                        <em class="fa fa-angle-double-up"></em>
                        Less&nbsp;&nbsp;</span
                      >
                      <span v-else
                        ><em class="fa fa-angle-double-down"></em> More</span
                      >&nbsp;</b-button
                    >
                    <button
                      class="btn btn-danger ml-1"
                      @click="removeRepeater(index)"
                    >
                      <em class="fa fa-times"></em> Remove
                    </button>
                  </div>
                  <b-collapse
                    @show="collapseShow(index)"
                    @hide="collapseHide(index)"
                    :id="'collapse-' + index"
                    class="mt-2 col-md-12"
                    :visible="site_section.expanded"
                  >
                    <!-- <hr /> -->
                    <b-row>
                      <div class="col-md-6">
                        <label for="section">Section</label>
                        <v-select
                          v-model="site_section.section"
                          :options="sectionsArray"
                          label="name"
                          @input="sectionChanged($event, index)"
                        />
                      </div>
                      <div class="col-md-6">
                        <label for="section">Employee</label>
                        <v-select
                          v-model="site_section.employee"
                          :options="employeesArray"
                          label="name"
                          @input="employeeChanged($event, index)"
                        />
                      </div>
                      <div class="col-md-12">
                        <star-rating
                          style="margin-top: 28px"
                          :max-rating="10"
                          :glow="2"
                          :animate="true"
                          :inline="true"
                          :text-class="black"
                          :star-size="starSize"
                          v-model="site_section.rating"
                        >
                        </star-rating>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label>Remarks</label>
                        <textarea
                          v-model="site_section.remark"
                          class="form-control"
                          placeholder="Write something"
                        ></textarea>
                      </div>
                      <div class="col-md-12 mt-2">
                        <vue-dropzone
                          :ref="index + 'ref'"
                          :useCustomSlot="true"
                          :id="index + 'dropzone'"
                          :duplicateCheck="true"
                          :options="dropzoneOptions"
                          @vdropzone-removed-file="fileRemoved(index, $event)"
                          @vdropzone-error="errorMessage"
                          @vdropzone-success="uploadSuccess(index, $event)"
                        ></vue-dropzone>
                      </div>
                    </b-row>
                  </b-collapse>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="selected_data.site != null" class="row mt-2">
        <div class="col-md-12 d-flex flex-row-reverse">
          <button class="btn btn-info text-white" @click="addRepeater">
            <em class="fa fa-plus"></em> Add Another Section
          </button>
        </div>
      </div>
      <div v-if="selected_data.site != null" class="card m-b-30 mt-4">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row pb-5 mt-2">
                <div class="col-md-12">
                  <label>Signature</label>
                </div>
                <div class="col-md-6">
                  <VueSignaturePad
                    :customStyle="{ border: '1px solid black' }"
                    width="100%"
                    height="100px"
                    ref="signaturePad"
                  />
                </div>
                <div class="col-md-6">
                  <button
                    v-if="form.signature_id != null"
                    class="btn btn-success"
                    @click="save"
                  >
                    Confirmed
                  </button>
                  <button v-else class="btn btn-primary" @click="save">
                    Confirm
                  </button>
                  <br />
                  <button class="btn btn-danger mt-2" @click="undo">
                   &nbsp; Clear &nbsp;&nbsp;
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="selected_data.site != null" class="row pb-5 mt-2">
        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-success">
            Submit
          </button>
        </div>
      </div>

      <div v-if="selected_data.site == null" class="row pb-5 mt-2">
        <div class="col-md-12 text-center">
          <h5 style="opacity:0.5">Select site to load data !</h5>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["sites", "employees", "sections"],
  data() {
    return {
      dropzoneOptions: {
        url: route("upload.store"),
        thumbnailWidth: 150,
        maxFilesize: 10,
        addRemoveLinks: true,
        headers: {
          "My-Awesome-Header": "header value",
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
            .content,
        },
      },

      form: {
        site_id: "",
        date: "",
        signature_id: null,
        site_sections: [],
      },
      selected_data: {
        site: null,
      },
    };
  },
  computed: {
    siteArray() {
      return JSON.parse(this.sites);
    },
    employeesArray() {
      return JSON.parse(this.employees);
    },
    sectionsArray() {
      return JSON.parse(this.sections);
    },
    starSize() {
      let screenWidth = screen.width;
      if (screenWidth > 565) {
        return 30; //function to transform your src to large
      } else if (screenWidth > 398) {
        return 30;
      } else if (screenWidth > 360) {
        return 25;
      } else {
        return 20;
      }
    },
  },
  mounted() {
    this.addSection();
    this.form.date =  new Date().toISOString().slice(0, 10)

  },
  methods: {
    loadSections(site) {
      this.form.site_sections = [];
      if (site && site.site_sections.length > 0) {
        site.site_sections.forEach((item) => {
          let object = {
            expanded: false,
            section_id: item.section_id,
            section_name: item.section.name,
            employee_name: "Employee name",
            rating: 0,
            employee_id: "",
            remark: "",
            section: item.section,
            employee: null,
            files: [],
          };
          this.form.site_sections.push(object);
        });
      }
    },
    addSection() {
      let object = {
        expanded: false,
        section_id: "",
        section_name: "Section name",
        employee_name: "Employee name",
        rating: 0,
        employee_id: "",
        remark: "",
        section: null,
        employee: null,
        files: [],
      };
      this.form.site_sections.push(object);
    },
    signatureUpload(file) {
      let data = new FormData();
      data.append("file", file);
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      axios
        .post(route("upload.storeSignature"), data, config)
        .then((response) => {
          if (response.data.successMessage) {
            this.form.signature_id = response.data.upload_id;
          }
        });
    },
    undo() {
      event.preventDefault();
      this.$refs.signaturePad.undoSignature();
      this.form.signature_id = null;
    },
    save() {
      event.preventDefault();
      const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
      if (!isEmpty) {
        this.signatureUpload(data);
      }
    },
    collapseShow(index) {
      this.form.site_sections[index].expanded = true;
    },
    collapseHide(index) {
      this.form.site_sections[index].expanded = false;
    },
    fileRemoved(index, file) {
      let media_id = JSON.parse(file.xhr.responseText).upload_id;
      var position = this.form.site_sections[index].files.indexOf(media_id);
      if (position > -1) {
        this.form.site_sections[index].files.splice(position, 1);
      }
    },
    uploadSuccess(index, file) {
      let response = JSON.parse(file.xhr.response);
      if (response.successMessage != null) {
        this.form.site_sections[index].files.push(response.upload_id);
        showSuccess(response.successMessage);
      }
    },

    errorMessage(file, message) {
      showError(message.message);
    },

    rating(rating, index) {
      this.form.site_sections[index].rating = rating;
    },
    /* Form repeater functions : Start */
    addRepeater() {
      event.preventDefault();
      let newObject = {
        expanded: false,
        section_id: "",
        section_name: "Section name",
        employee_name: "Employee name",
        rating: 0,
        employee_id: "",
        remark: "",
        section: null,
        employee: null,
        files: [],
      };
      this.form.site_sections.push(newObject);
    },

    removeRepeater(index) {
      event.preventDefault();
      this.form.site_sections.splice(index, 1);
    },
    /* Form repeater functions : End */
    siteChanged(item) {
      this.form.site_id = item ? item.id : null;
      this.loadSections(item);
    },
    sectionChanged(item, index) {
      this.form.site_sections[index].section_id = item ? item.id : null;
      this.form.site_sections[index].section_name = item ? item.name : "";
    },
    employeeChanged(item, index) {
      this.form.site_sections[index].employee_id = item ? item.id : null;
      this.form.site_sections[index].employee_name = item ? item.name : null;
    },
    submitForm() {
      event.preventDefault();
      axios
        .post(route("report.store"), this.form)
        .then((response) => {
          if (response.data.successMessage) {
            showSuccess(response.data.successMessage);
            this.clearForm();
            setTimeout(() => {
              window.location.replace(
                route("report.index", { successMessage: "Success" })
              );
            }, 1000);
          }
          if (response.data.errorMessage) {
            window.scrollTo(0, 0);
            showError(response.data.errorMessage);
          }
        })
        .catch(function (error) {
          showError(error.message);
        });
    },
    clearForm() {
      window.scrollTo(0, 0);
      let form = {
        site_id: "",
        date: "",
        site_sections: [],
      };
      this.form = form;
      this.addRepeater();
      this.selected_data.site = null;
    },
  },
};
</script>
<style scoped>
.toggle-btn-color{
    background: gray;
    border: none;
}
</style>
