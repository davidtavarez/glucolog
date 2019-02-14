class Routes(object):
    utils_states = '/utils/state'

    auth_login = '/auth/login'
    auth_register = '/auth/register'
    auth_logout = '/auth/logout'
    auth_token_refresh = '/auth/refresh-token'
    auth_logout_refresh = '/auth/loguout/refresh'

    user_profile = '/users/me'

    user_avatar = '/users/me/avatar'

    user_weight_list = '/users/me/weight'
    user_weight_details = '/users/me/weight/<int:id>'
    user_weight_photo = '/users/me/weight/<int:id>/picture'

    user_glycaemia_list = '/users/me/glycaemia'
    user_glycaemia_details = '/users/me/glycaemia/<int:id>'
    user_glycaemia_photo = '/users/me/glycaemia/<int:id>/picture'
    user_glycaemia_food_list = '/users/me/glycaemia/<int:gid>/food'
    user_glycaemia_food_add = '/users/me/glycaemia/<int:gid>/food/add'
    user_glycaemia_food_details = '/users/me/glycaemia/<int:gid>/food/<int:id>'
    user_glycaemia_food_delete = '/users/me/glycaemia/<int:gid>/food/delete/<int:id>'
    user_glycaemia_food_edit = '/users/me/glycaemia/<int:gid>/food/edit/<int:id>'
    
    

    user_keys_readonly_list = '/users/me/key'
    user_keys_readonly_details = '/users/me/key/<int:id>'

    user_charts_glycaemia = '/charts/glycaemia'
    user_charts_weight = '/charts/weight'
