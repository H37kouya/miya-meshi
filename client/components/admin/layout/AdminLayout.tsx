import TheHeader from "./TheHeader"
import TheSidebar from "./TheSidebar"

const Layout = ({ children }): JSX.Element => {
    return (
        <div>
            <TheHeader />

            <TheSidebar />

            {children}
        </div>
    )
}

export default Layout