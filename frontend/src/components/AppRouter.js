import React, {Component, useContext} from 'react';

import {Redirect, Switch, Route} from "react-router-dom";
import {publicRoutes, privateRoutes} from "../utils/actions";
import {ROUTE_HOME} from "../utils/consts";
import {Context} from "../index";
import {observer} from "mobx-react-lite";

const AppRouter = observer(() => {

    const {user} = useContext(Context);

    console.log(user);
    return (
        <Switch>
            {user.isAuth && privateRoutes.map(({path, Component}) =>
                <Route key={path} path={path} component={Component} exact/>
            )}

            {publicRoutes.map(({path, Component}) =>
                <Route key={path} path={path} component={Component} exact/>
            )}

            <Redirect to={ROUTE_HOME}/>
        </Switch>
    );
})

export default AppRouter;