<template>
  <div>
    <div class="card m-b-30">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Sites</label>
                <input class="form-control" type="text" disabled :value="report.site.name" />
              </div>
              <div class="col-md-6">
                <label>Date</label>
                <input class="form-control" type="text" disabled :value="report.date" />
              </div>
              <div v-if="report.supervisor_comment != null" class="col-md-12">
                <label>Supervisor Commnent</label>
                <textarea class="form-control"  :value="report.supervisor_comment" disabled>
                </textarea>
              </div>
              <div v-if="report.site_admin_comment != null" class="col-md-12">
                <label>Site Admin Commnent</label>
                <textarea class="form-control" :value="report.site_admin_comment" disabled>
                </textarea>
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
              v-for="(report_section, index) in this.report.report_sections"
              :key="index"
              class="form-group"
            >
              <div class="row">
                <div class="col-md-12">
                  <hr />
                </div>
                <div class="col-md-5">
                  <label for="section">Section</label>
                  <input
                    class="form-control"
                    type="text"
                    disabled
                    :value="report_section.section.name"
                  />
                </div>
                <div class="col-md-7">
                  <label for="section">Employee</label>
                  <input class="form-control" :value="report_section.employee.user.name" type="text" disabled />
                </div>
                <div class="col-md-12">
                   <label
                      >Rating
                      <span class="vue-star-rating-rating-text">{{
                        report_section.rating
                      }}</span>
                    </label>
                    <star-rating
                      :max-rating="10"
                      :glow="2"
                      :show-rating="false"
                      :star-size="starSize"
                      :rating="report_section.rating"
                      :read-only="true"
                    >
                    </star-rating>
                </div>
                <div class="col-md-12">
                    <label>Remarks</label>
                    <textarea class="form-control" disabled v-model="report_section.description">
                    </textarea>
                  </div>
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
        sections:[]
    };
  },
  computed: {
    report() {
      return JSON.parse(this.record);
    },
  },
  mounted:{

  }
};
</script>
