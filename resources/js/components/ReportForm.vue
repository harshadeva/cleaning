<template>
  <div>
    <form @submit="submitForm">
      <div class="card m-b-30">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Sites</label>
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
      <div class="card m-b-30">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div
                v-for="(site_section, index) in this.form.site_sections"
                :key="index"
                class="form-group"
              >
                <div class="row">
                  <div class="col-md-12">
                    <hr />
                  </div>
                  <div class="col-md-5">
                    <label for="section">Section</label>
                    <v-select
                      v-model="form.site_sections[index].section"
                      :options="sectionsArray"
                      label="name"
                      @input="sectionChanged($event, index)"
                    />
                  </div>
                  <div class="col-md-7">
                    <label for="section">Employee</label>
                    <v-select
                      v-model="form.site_sections[index].employee"
                      :options="employeesArray"
                      label="name"
                      @input="employeeChanged($event, index)"
                    />
                  </div>
                  <div class="col-md-12">
                    <label
                      >Rating
                      <span class="vue-star-rating-rating-text">{{
                        form.site_sections[index].rating
                      }}</span>
                    </label>
                    <star-rating
                      :max-rating="10"
                      :glow="2"
                      :animate="true"
                      :inline="true"
                      :show-rating="false"
                      :star-size="starSize"
                      v-model="form.site_sections[index].rating"
                      @rating-selected="setRating($event, index)"
                    >
                    </star-rating>
                  </div>
                  <div class="col-md-12">
                    <label>Remarks</label>
                    <input
                      v-model="form.site_sections[index].remark"
                      type="text"
                      class="form-control"
                      placeholder="Remark"
                    />
                  </div>
                  <div class="col-md-12 mt-3">
                    <button
                      class="btn btn-danger"
                      @click="removeRepeater(index)"
                    >
                      <em class="fa fa-times"></em> Remove
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mt-3">
                  <button class="btn btn-info" @click="addRepeater">
                    <em class="fa fa-plus"></em> Add Another Section
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5 mt-n3">
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
  props: ["sites", "employees", "sections"],
  data() {
    return {
      form: {
        site_id: "",
        date: "",
        site_sections: [
          {
            section_id: "",
            rating: 0,
            employee_id: "",
            remark: "",
            section: null,
            employee: null,
          },
        ],
      },
      selected_data: {
        site: {},
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
        return 40; //function to transform your src to large
      } else if (screenWidth > 398) {
        return 35;
      } else if (screenWidth > 310) {
        return 25;
      } else {
        return 20;
      }
    },
  },
  methods: {
    setRating(rating, index) {
      this.form.site_sections[index].rating = rating;
    },
    /* Form repeater functions : Start */
    addRepeater() {
      event.preventDefault();
      let newObject = {
        section_id: "",
        rating: 0,
        employee_id: "",
        remark: "",
        section: null,
        employee: null,
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
    },
    sectionChanged(item, index) {
      this.form.site_sections[index].section_id = item ? item.id : null;
    },
    employeeChanged(item, index) {
      this.form.site_sections[index].employee_id = item ? item.id : null;
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
          console.log(error);
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
            section: null,
            employee: null,
          },
        ],
      };
      this.form = form;
      this.selected_data.site = null;
    },
  },
};
</script>
