<template>
  <div>
    <form @submit="submitForm">
      <div class="card m-b-30">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h6>
                    Register cleaning sections in
                    <strong>"{{ site.name }}"</strong>
                  </h6>
                  <hr />
                </div>
              </div>

              <div
                v-for="(site_section, index) in this.form.site_sections"
                :key="index"
                class="row"
              >
                <div class="col-md-12">
                  <div class="row">
                      <div class="col-md-4">
                      <label>Section</label>
                       <input
                    type="text"
                    v-model="site_section.section"
                    class="form-control"
                    placeholder="Section name"
                  />
                    </div>
                    <div class="col-md-4">
                      <label>Employee</label>
                      <v-select
                        v-model="site_section.employee"
                        :options="employees"
                        @input="employeeChanged($event, index)"
                        label="name"
                      />
                    </div>
                    <div class="col-md-4">
                      <button
                        style="margin-top: 27px"
                        class="btn btn-danger"
                        @click="removeRepeater(index)"
                      >
                        <em class="fa fa-times"></em> Remove
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button
                    class="btn btn-info mt-2 text-white"
                    @click="addRepeater($event)"
                  >
                    <em class="fa fa-plus"></em> Add new
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row pb-5">
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
  props: ["employees", "site"],
  data() {
    return {
      form: {
        site_id: this.site.id,
        site_sections: [],
      },
    };
  },
  mounted() {
    if (this.site.site_sections.length > 0) {
      this.loadSections();
    } else {
      this.addRepeater();
    }
  },
  methods: {
    loadSections() {
      this.site.site_sections.forEach((item) => {
        this.form.site_sections.push({
            id:item.id,
          employee_id: item.employee_id,
          employee: item.employee,
          section: item.name,
        });
      });
    },
    removeRepeater(index) {
      event.preventDefault();
      this.form.site_sections.splice(index, 1);
    },
    employeeChanged(item, index) {
      if (item != null) {
        this.form.site_sections[index].employee_id =
          this.form.site_sections[index].employee.id;
      } else {
        this.form.site_sections[index].employee_id = null;
      }
    },
    addRepeater(event = null) {
      if (event) {
        event.preventDefault();
      }
      let object = {
          id:null,
        section: null,
        employee: null,
        employee_id: "",
      };
      this.form.site_sections.push(object);
    },
    submitForm() {
      event.preventDefault();
      axios
        .post(route("site_section.update"), this.form)
        .then((response) => {
          if (response.data.successMessage) {
            showSuccess(response.data.successMessage);
            setTimeout(() => {
              window.location.replace(route("site.index"));
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
  },
};
</script>
