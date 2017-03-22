/**
 * Pipeline Node Class
 *
 * This class has all the functionality for the pipeline
 * nodes where we can create, edit, update or whatever we
 * want to do related to nodes.
 */
class Node {

    /**
     * Constructor for node objects
     * @param  {number} the id of the node
     * @param  {string} the name for the node
     * @param  {number} the hierarchy level on the diagram
     * @param  {object} the pipeline object
     * @param  {string} the node type
     * @param  {string} the status of the node (if message)
     */
    constructor(id, name, hierarchy_level, pipeline, type, status) {

        this.id                 = id;
        this.name               = name;
        this.type               = type;
        this.pipeline           = pipeline;
        this.hierarchy_level    = hierarchy_level;
        this.status             = status;
    }

    /**
     * Getter for the node image
     * @return {string} the path where the icon is
     */
    get icon() {
        return this.getIconFromType();
    }

    /**
     * Helper function to get the icon per node type
     * @return {string} the path where the icon is
     */
    getIconFromType() {

        let path = '/images/terminal.png';

        switch(this.type) {
            case 'start':
                path = '/images/light-bulb.png';
                break;
            case 'script':
                path = '/images/terminal.png';
                break;
            case 'api':
                path = '/images/cloud.png';
                break;
        }
        return path;
    }

    /**
     * Helper function to get the icon per node status
     * @return {string} the path where the icon is
     */
    getIconFromStatus() {

        let path = '/images/cloud.png';

        switch(this.type) {
            case 'OK':
                path = '/images/sign-check.png';
                break;
            case 'ERROR':
                path = '/images/sign-error.png';
                break;
        }
        return path;
    }

    /**
     * Static method to create new nodes
     * @param  {string} Node name
     * @param  {string} Node type
     * @param  {number} The parent node id
     * @param  {number} The Pipeline id
     */
    static create(name, type, from_node_id, pipeline_id, onSuccess) {

        // get the url to create a node
        let url = '/pipeline/' + pipeline_id + '/nodes';

        $.post({
            url: url,
            data: {
                name: name,
                type: type,
                from_node_id: from_node_id,
                pipeline_id: pipeline_id,
                _token: Laravel.csrfToken
            }
        }).done(function(){
            if (onSuccess) { onSuccess(); }
        });

    }

    /**
     * Method that deletes the node from the database and
     * reloads the data so the diagram is refreshed.
     */
    destroy(onSuccess, onError) {

        var self = this;

        // get the url to delete a node
        let url = '/pipeline/' + this.pipeline.id + '/nodes/' + this.id;

        var delete_data = {
            _method: 'DELETE',
            _token: Laravel.csrfToken
        };

        // calls the backend to delete a node
        $.post({
            url: url,
            data: delete_data
        }).done(function(resp){
            if (resp.success && onSuccess) {
                onSuccess();
            } else if (onError) {
                onError();
            }
        }).fail(function(){
            if (onError) { onError(); }
        });
    }

    /**
     * This Helper method gets the data that visjs requires
     * to render the node in the network diagram.
     * @return {json} The Vis node config object
     */
    toVisObject() {
        return {
            id: this.id,
            label: this.name,
            level: this.hierarchy_level,
            image: this.icon
        };
    }

}

// Export this module
module.exports = Node;




