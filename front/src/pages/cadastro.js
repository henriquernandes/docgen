import ApplicationLogo from '@/components/ApplicationLogo'
import AuthCard from '@/components/AuthCard'
import Button from '@/components/Button'
import GuestLayout from '@/components/Layouts/GuestLayout'
import Input from '@/components/Input'
import InputError from '@/components/InputError'
import Label from '@/components/Label'
import Link from 'next/link'
import { useAuth } from '@/hooks/auth'
import { useState } from 'react'

const Cadastro = () => {
    const { register } = useAuth({
        middleware: 'guest',
        redirectIfAuthenticated: '/dashboard',
    })

    const [form, setForm] = useState({
        nome: '',
        email: '',
        password: '',
        password_confirmation: '',
        matricula: '',
        empresa_id: '',
    })
    const [errors, setErrors] = useState([])

    const handleChange = event => {
        setForm({...form, [event.target.id]: event.target.value});
    }

    const submitForm = event => {
        event.preventDefault()

        register({
            ...form,
            setErrors,
        })
    }

    return (
        <GuestLayout>
            <AuthCard
                logo={
                    <Link href="/">
                        <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                }>
                <form onSubmit={submitForm}>
                <h3 className="text-2xl font-semibold pb-4">Cadastro usuário</h3>
                <div className="grid grid-cols-2 gap-4">
                    {/* Nome */}
                    <div>
                        <Label htmlFor="nome">Nome</Label>

                        <Input
                            id="nome"
                            type="text"
                            value={form.nome}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                            required
                            autoFocus
                        />

                        <InputError messages={errors.name} className="mt-2" />
                    </div>

                    <div>
                        <Label htmlFor="empresa_id">Referência da empresa</Label>

                        <Input
                            id="empresa_id"
                            type="text"
                            value={form.empresa_id}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                        />

                        <InputError messages={errors.text} className="mt-2" />
                    </div>

                    {/* Email */}
                    <div className="mt-4">
                        <Label htmlFor="email">Email</Label>

                        <Input
                            id="email"
                            type="email"
                            value={form.email}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                            required
                        />

                        <InputError messages={errors.email} className="mt-2" />
                    </div>

                    {/* Matricula */}
                    <div className="mt-4">
                        <Label htmlFor="matricula">Matricula</Label>

                        <Input
                            id="matricula"
                            type="text"
                            value={form.matricula}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                        />

                        <InputError
                            messages={errors.matricula}
                            className="mt-2"
                        />
                    </div>

                    {/* Senha */}
                    <div className="mt-4">
                        <Label htmlFor="password">Senha</Label>

                        <Input
                            id="password"
                            type="password"
                            value={form.password}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                            required
                            autoComplete="nova-password"
                        />

                        <InputError
                            messages={errors.password}
                            className="mt-2"
                        />
                    </div>

                    {/* Confirmar Senha */}
                    <div className="mt-4">
                        <Label htmlFor="password_confirmation">
                            Confirmar Senha
                        </Label>

                        <Input
                            id="password_confirmation"
                            type="password"
                            value={form.password_confirmation}
                            className="block mt-1 w-full"
                            onChange={handleChange}
                            required
                        />

                        <InputError
                            messages={errors.password_confirmation}
                            className="mt-2"
                        />
                    </div>
                </div>
                    <div className="flex items-center justify-end mt-4">
                        <Link
                            href="/login"
                            className="underline text-sm text-gray-600 hover:text-gray-900">
                            Já cadastrado?
                        </Link>

                        <Button className="ml-4">Cadastrar</Button>
                    </div>
                </form>
            </AuthCard>
        </GuestLayout>
    )
}

export default Cadastro
