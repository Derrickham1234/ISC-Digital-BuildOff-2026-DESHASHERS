# Use Case Diagram

```mermaid
flowchart LR
    S([Student])
    A([Administrator])
    subgraph SYS[UEAB Smart Noticeboard]
        U1(Register account)
        U2(Log in / Log out)
        U3(View published notices)
        U4(Read a notice)
        U5(Search notices)
        U6(Create notice)
        U7(Edit / delete notice)
        U8(Publish or save as draft)
        U9(View notice statistics)
    end
    S --> U1 & U2 & U3 & U4 & U5
    A --> U2 & U6 & U7 & U8 & U9
```

## User stories
- As a student, I want to see all official notices in one place so that I do not miss important information.
- As a student, I want to search notices so that I can find a specific announcement quickly.
- As an administrator, I want to publish a notice once so that I do not repeat it across many channels.
- As an administrator, I want to save a draft so that I can finish a notice before students see it.
