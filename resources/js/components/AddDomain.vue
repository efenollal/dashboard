<template>
  <application>
    <template v-slot:content>
      <v-container class="pa-4" fluid>
        <v-card :loading="loading">
          <v-card-title>Add Domains</v-card-title>
          <v-card-text>
            <v-alert
              type="error"
              :dismissible="true"
              v-if="errors.domain_name"
            >{{ errors.domain_name[0] }}</v-alert>
            <v-alert type="success" :dismissible="true" v-if="message">{{ message }}</v-alert>
            <v-textarea
              v-model="domains"
              filled
              label="Domains"
              :placeholder="'example.com\nxn--sxqv5g23dyr3a428a.com\n测试假域名.com'"
              hint="Enter one domain name per line."
              persistent-hint
            />
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" width="100%" @click="handleSave">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-container>
    </template>
  </application>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      domains: "",
      errors: "",
      message: ""
    };
  },
  methods: {
    handleSave() {
      console.log("handle save!");

      let filtered = this.domains.split("\n").filter(domain => {
        return /\S/.test(domain);
      });
      let domain_name = filtered.map(dom => {
        {
          return {
            domain_name: dom.trim(),
            is_idn: 1,
            created_at: this.getDateTime(),
            updated_at: this.getDateTime()
          };
        }
      });

      Axios.post("/api/domains", { domain_name })
        .then(response => {
          console.log(response);
          this.message = "Domain created successfully!";
          this.domains = "";
          //   this.$router.push({ name: "domains" });
        })
        .catch(error => {
          //   console.log(error.response.status);
          if (error.response.status == 422) {
            this.errors = [];
            this.errors = error.response.data.errors;
          }
        });
    },
    getDateTime() {
      let today = new Date();
      let date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      let time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

      return date + " " + time;
    }
  }
};
</script>
