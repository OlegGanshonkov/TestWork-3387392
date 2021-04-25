import Vue from 'vue';
import Vuex from 'vuex';
import axios from "axios";
import _ from 'lodash';
import api from "./api/publications";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        publications: [],
        message: '',
    },
    mutations: {
        setPublications(state, params) {
            state.publications = params.data;
        },
        editPublication(state, params) {
            axios
                .put(`/api/publications/${params.id}`, params.data)
                .then((response) => {
                    this.state.message = 'Successfully updated';
                    Bus.$emit('flash-message', this.state.message);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        createPublication(state, params) {
            axios
                .post(`/api/publications`, params.data)
                .then((response) => {
                    this.state.message = 'Successfully created';
                    Bus.$emit('flash-message', this.state.message);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        deletePublication(state, params) {
            axios
                .delete(`/api/publications/${params.id}`)
                .then((response) => {
                    this.state.message = 'Successfully deleted';
                    Bus.$emit('flash-message', this.state.message);
                    let publication = _.find(this.state.publications, {id: params.id});
                    state.publications = _.without(state.publications, publication);
                })
                .catch(error => {
                    console.log(error)
                });
        },

    },

    getters: {
        PublicationsData(state) {
            return state.publications;
        },
    }
});
