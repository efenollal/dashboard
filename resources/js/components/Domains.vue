<template>
  <application>
    <template v-slot:content>
      <v-container class="pa-4" fluid>
        <v-card>
          <v-card-title>
            Domains
            <div class="flex-grow-1" />
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
              @input="handleSearch"
            />
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="domains"
            :loading="loading"
            hide-default-footer
            disable-sort
          >
            <template v-slot:body="{ items }">
              <tbody v-if="!search">
                <tr v-for="item in items" :key="item.id">
                  <td>{{ item.domain_name }}</td>
                  <td>{{ new Date(item.updated_at).toLocaleString() }}</td>
                  <td>{{ item.is_idn ? 'Yes' : 'No' }}</td>
                  <td>{{ item.is_imprinted ? 'Yes' : 'No' }}</td>
                  <td>
                    <v-btn icon @click="handleImprint(item.id)">
                      <v-icon>mdi-fingerprint</v-icon>
                    </v-btn>
                    <v-btn icon @click="handleDelete(item.id)">
                      <v-icon>mdi-delete</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr v-for="item in results" :key="item.id">
                  <td>{{ item.domain_name }}</td>
                  <td>{{ new Date(item.updated_at).toLocaleString() }}</td>
                  <td>{{ item.is_idn ? 'Yes' : 'No' }}</td>
                  <td>{{ item.is_imprinted ? 'Yes' : 'No' }}</td>
                  <td>
                    <v-btn icon @click="handleImprint(item.id)">
                      <v-icon>mdi-fingerprint</v-icon>
                    </v-btn>
                    <v-btn icon @click="handleDelete(item.id)">
                      <v-icon>mdi-delete</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-data-table>
        </v-card>
        <v-btn fab color="primary" bottom right absolute to="/domains/add">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-container>
    </template>
  </application>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      loading: false,
      selected: false,
      search: "",
      results: [],
      headers: [
        { text: "Domain Name", value: "domain_name" },
        { text: "Updated At", value: "updated_at" },
        { text: "Internationalized", value: "is_idn" },
        { text: "Imprinted", value: "is_imprinted" },
        { text: "Actions" }
      ],
      domains: []
    };
  },
  mounted() {
    this.fetchDomains();
  },
  watch: {
    keywords(after, before) {
      this.handleSearch();
    }
  },
  methods: {
    async fetchDomains() {
      try {
        this.loading = true;
        const domains = await axios.get("/api/domains");
        this.domains = domains.data;
      } catch (e) {
        console.log(e);
      } finally {
        this.loading = false;
      }
    },
    handleSearch(value) {
      console.log("handle the search!", value);

      axios
        .get("api/domains/search", { params: { query: this.search } })
        .then(response => {
          this.results = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    handleDelete(id) {
      console.log("handle the delete!");

      try {
        const domains = axios.delete(`api/domains/${id}`).then(response => {
          this.fetchDomains();
        });
      } catch (e) {
        console.log(e);
      }
    },
    handleImprint(id) {
      console.log("handle the imprint!");

      this.selected = !this.selected;
      const imprint = axios
        .put(`api/domains/${id}`, { is_imprinted: this.selected })
        .then(response => {
          this.fetchDomains();
        })
        .catch(e => {
          console.log(e.response.data.errors);
        });
    }
  }
};
</script>
