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
  props: ["record", "employees", "sections"],
  data() {
    return {
      form: {
        _method: "PUT",
        id: "",
        date: "",
        site_sections: [
          {
            id: "",
            section_id: "",
            rating: 0,
            employee_id: "",
            remark: "",
            section: null,
            employee: null,
          },
        ],
      },
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
  mounted() {
    this.form.date = this.recordArray.date;
    this.form.id = this.recordArray.id;
    this.recordArray.report_sections.forEach((value, key) => {
      let newObject = {
        id: value.id,
        section_id: value.section_id,
        rating: value.rating,
        remark: value.description,
        employee_id: value.employee_id,
        employee: value.employee,
        section: value.section,
      };
      this.form.site_sections[key] = newObject;
    });
  },
  methods: {
    setRating(rating, index) {
      this.form.site_sections[index].rating = rating;
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
    sectionChanged(item, index) {
      this.form.site_sections[index].section_id = item ? item.id : null;
    },
    employeeChanged(item, index) {
      this.form.site_sections[index].employee_id = item ? item.id : null;
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
