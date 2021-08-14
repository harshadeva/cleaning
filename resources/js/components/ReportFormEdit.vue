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
                  <input
                    type="text"
                    readonly
                    :value="recordArray.site.name"
                    class="form-control"
                    placeholder="Site name"
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
      <div
        v-for="(site_section, index) in this.form.site_sections"
        :key="index"
        class="card"
      >
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 pb-2">
                  <em class="fa fa-building"></em>
                  <span>{{ site_section.section_name }}</span>
                </div>
                <div class="col-md-6 pb-2">
                  <em class="fa fa-user"></em>
                  <span>{{ site_section.employee_name }}</span>
                  &nbsp;
                  <em class="fa fa-star pb-2"></em>
                  <span>{{ site_section.rating }}</span>
                  &nbsp; &nbsp;
                  <em class="fa fa-image pb-2"></em>
                  <span>{{ site_section.files.length }}</span>
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
                    class="btn-top-margin btn btn-primary"
                  >
                    <span v-if="site_section.expanded">
                      <em class="fa fa-angle-double-up"></em>
                      Less&nbsp;&nbsp;</span
                    >
                    <span v-else
                      ><em class="fa fa-angle-double-down"></em> More</span
                    ></b-button
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
                  <hr />
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
                        :ref="index + 'dropzoneRef'"
                        :id="index + 'dropzone'"
                        :duplicateCheck="true"
                        :options="dropzoneOptions"
                        @vdropzone-removed-file="fileRemoved(index, $event)"
                        @vdropzone-error="errorMessage"
                        @vdropzone-success="uploadSuccess(index, $event)"
                      ></vue-dropzone>
                    </div>
                    <div class="col-md-12 mt-3">
                      <button
                        class="btn btn-danger"
                        @click="removeRepeater(index)"
                      >
                        <em class="fa fa-times"></em> Remove
                      </button>
                    </div>
                  </b-row>
                </b-collapse>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-12 d-flex flex-row-reverse">
          <button class="btn btn-info" @click="addRepeater">
            <em class="fa fa-plus"></em> Add Another Section
          </button>
        </div>
      </div>
       <div class="card m-b-30 mt-4">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row pb-5 mt-2">
                <div class="col-md-12">
                  <u>Signature</u>
                </div>
                <div class="col-md-6">
                  <VueSignaturePad v-if="signature_edited"
                    :customStyle="{ border: '1px solid black' }"
                    width="100%"
                    height="100px"
                    ref="signaturePad"
                  />
                        <img v-else alt="signature" height="100px" width="100%" :src="selected_data.signature">

                </div>
                <div class="col-md-6">
                  <button
                    v-if="form.signature_id != null"
                    class="btn btn-success"
                    @click="save"
                  >
                    Confirmed <em class="fa fa-check"> </em>
                  </button>
                  <button v-else class="btn btn-primary" @click="save">
                    Confirm <em class="fa fa-question-circle"></em>
                  </button>
                  <br />
                  <button class="btn btn-danger mt-2" @click="undo">
                    Clear &nbsp;<em class="fa fa-history"></em>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5 pb-5 mt-n3">
        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-success">
            Submit
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["record", "employees", "sections"],
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
      signature_edited:false,
      form: {
        _method: "PUT",
        id: "",
        date: "",
        signature_id: null,
        site_sections: [],
      },
      selected_data:{
          signature:""
      }
    };
  },
  computed: {
    recordArray() {
      return JSON.parse(this.record);
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
    this.form.date = this.recordArray.date;
    this.form.id = this.recordArray.id;
    this.form.signature_id = this.recordArray.signature_id;
    this.selected_data.signature = this.recordArray.signature.path['original'];
    this.recordArray.report_sections.forEach((report_section, key) => {
      this.setSectionData(report_section);
      this.setDropzones(report_section, key);
    });
     this.$refs.signaturePad.lockSignaturePad();
     this.$refs.signaturePad.addImages([this.recordArray.signature.path['original']]);
  },
  methods: {
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
     this.signature_edited = true;
      this.form.signature_id = null;
      this.$refs.signaturePad.undoSignature();
     this.$refs.signaturePad.openSignaturePad();

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
    setSectionData(report_section) {
      let object = {
        expanded: false,
        section_name: report_section.section.name,
        employee_name: report_section.employee.name,
        id: report_section.id,
        section_id: report_section.section_id,
        rating: report_section.rating,
        remark: report_section.description,
        employee_id: report_section.employee_id,
        employee: report_section.employee,
        section: report_section.section,
        files: report_section.report_section_medias.map((a) => a.media.id),
      };
      this.form.site_sections.push(object);
    },
    setDropzones(report_section, key) {
      report_section.report_section_medias.forEach(
        (report_section_media, key2) => {
          let file = {
            size: 123,
            id: report_section_media.media.id,
            name: report_section_media.media.name,
            type: "image/png",
          };
          let url = report_section_media.media.path.thumbnail;
          let refName = key.toString() + "dropzoneRef";
          this.$nextTick(function () {
            this.$refs[refName][0].manuallyAddFile(file, url);
          });
        }
      );
    },
    fileRemoved(index, file) {
      if (file.id) {
        this.removeUploadedFile(index, file);
      } else {
        this.removeNewUploaded(index, file);
      }
    },
    removeUploadedFile(index, file) {
      var position = this.form.site_sections[index].files.indexOf(file.id);
      if (index > -1) {
        this.form.site_sections[index].files.splice(position, 1);
      }
    },
    removeNewUploaded(index, file) {
      let media_id = JSON.parse(file.xhr.responseText).upload_id;
      var position = this.form.site_sections[index].files.indexOf(media_id);
      if (index > -1) {
        this.form.site_sections[index].files.splice(position, 1);
      }
    },
    errorMessage(file, message) {
      showError(message.message);
    },
    uploadSuccess(index, file) {
      let response = JSON.parse(file.xhr.response);
      if (response.successMessage != null) {
        this.form.site_sections[index].files.push(response.upload_id);
        showSuccess(response.successMessage);
      }
    },
    /* Form repeater functions : Start */
    addRepeater() {
      event.preventDefault();
      let newObject = {
        id: "",
        section_id: "",
        rating: 0,
        employee_id: "",
        remark: "",
        section_name: "Section name",
        employee_name: "Employee name",
        expanded: null,
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
    sectionChanged(item, index) {
      this.form.site_sections[index].section_id = item ? item.id : null;
      this.form.site_sections[index].section_name = item ? item.name : "";
    },
    employeeChanged(item, index) {
      this.form.site_sections[index].employee_id = item ? item.id : null;
      this.form.site_sections[index].employee_name = item ? item.name : "";
    },
    submitForm() {
      event.preventDefault();
      axios
        .post(
          route("report.update", { report: this.recordArray.id }),
          this.form
        )
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
        site_sections: [
          {
            section_id: "",
            rating: 0,
            employee_id: "",
            remark: "",
            section_name: "Section name",
            employee_name: "Employee name",
            section: null,
            employee: null,
          },
        ],
      };
      this.form = form;
    },
  },
};
</script>
