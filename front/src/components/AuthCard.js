const AuthCard = ({logo, children, width}) => (
    <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>{logo}</div>

        <div className={`min-w-[28rem] max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg`}>
            {children}
        </div>
    </div>
)


export default AuthCard
