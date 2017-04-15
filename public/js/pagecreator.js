/**
 * The page creator namespace definition.
 *
 * @namespace Pagecreator
 */
var Pagecreator = {
    /**
     * @namespace Application
     */
    Utils: {
        Ajax: {},
        Search: {},
        Helper: {}
    },

    UI: {
        Events: {},
        Utils: {}
    }
};

/**
 * Create an namespace.
 *
 * @param namespace {string} The namespace to be created
 * @returns {Object}
 */
Pagecreator.createNamespace = function (namespace) {
    var space = namespace.split('.'), i, currentSpace = Pagecreator, spaceName;
    for (i = 0; i < space.length; i += 1) {
        spaceName = space[i];
        if (spaceName !== 'Pagecreator') {
            if (!currentSpace[spaceName]) {
                currentSpace[spaceName] = {};
            }
            currentSpace = currentSpace[spaceName];
        }
    }
    return currentSpace;
};